<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\MatchRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Gate;
use App\Match;
use App\MatchUser;

class MatchRepository extends AbstractRepository implements MatchRepositoryInterface
{
    protected $model = Match::class;

    public function paginate(int $paginate = 10, string $column = 'id', string $order = 'ASC'):LengthAwarePaginator
    {
      $user = auth()->user();

      if(Gate::denies('manage-bets')){
        $list = [];
        foreach ($user->bettings as $key => $betting) {
          foreach ($betting->rounds as $key => $round) {
            $list = $round->matches()->value('id');
          }
        }
        return $this->model->whereIn('id',$list)->orderBy($column, $order)->paginate($paginate);
      }

      return $this->model->orderBy($column, $order)->paginate($paginate);
      
    }

    public function findWhereLike(array $columns, string $search, string $column = 'id', string $order = 'ASC'):Collection
    {
        $query = $this->model;

        if (Gate::denies('manage-bets')) {
            $user = auth()->user();
            $list = [];
            foreach ($user->bettings as $betting){
                foreach ($betting->rounds as $round) {
                    $list[] = $round->matches()->value('id');
                }
            }
            foreach ($columns as $key => $value) {
                $query = $query->orWhere($value,'like','%'.$search.'%');
            }

            return $query->whereIn('round_id', $list)->orderBy($column,$order)->get();
        }

        foreach ($columns as $key => $value) {
            $query = $query->orWhere($value,'like','%'.$search.'%');
        }

        return $query->orderBy($column,$order)->get();
    }
  

    public function create(array $data):Bool
    {

        $user = auth()->user();
        $listRel = $user->rounds;//quais são as rodadas do usuário
        $round_id = $data['round_id'];//qual a rodada que vai ser criada
        $exist = false;

        foreach ($listRel as $key => $value) {/*verifica se o round pertence ao usuário*/
           if($round_id == $value->id){
                $exist = true;
           }
        }

        if($exist){
            return (bool) $this->model->create($data);
        }else{
            return false;
        }

    }

    public function update(array $data, int $id):Bool
    {
      $register = $this->findById($id);

      if(Gate::denies('manage-bets')){

        if($register){

          $user = auth()->user();
          $listRel = $user->rounds;
          $round_id = $data['round_id'];
          $exist = false;
      
          foreach ($listRel as $key => $value) {/*verifica se o registro pertence a determinado usuário*/
            if($round_id == $value->id){
                  $exist = true;
            }
          }
      
          if($exist){
            $this->calculatePoints($register);
              return (bool) $register->update($data);
          }else{
              return false;
          }
        
        }else{
          return false;
        }
      }

      $register = $this->find($id);
      if($register){
          return (bool) $register->update($data);
      }else{
        return false;
      }

    
    }

    public function calculatePoints($match){/*metodo responsavel pelo calculo de pontos, quando se encerra a partida*/

      $betting = $match->round->betting;
      $bettors = $betting->bettors;//pega todos os apostadores
      $now = now();//data de agora

      foreach ($bettors as $key => $user) {//laço de repetição dos apostadores
        $taxa = 0;
        $pontos = 0;
        $roundTitle = '';
        foreach ($betting->rounds as $key => $roundValue) {//laço de repetição das rodadas
          if( $roundValue->date_end < $now){//se a rodada esta finalizada
            $roundTitle = $roundValue->title;
            foreach ($roundValue->matches as $key => $matchValue) {//laço de repetição das partidas
              if($user->matches->contains($matchValue)){//verifica se o usuário fez uma aposta
                $bet = $user->matches()->find($matchValue->id);//pega o registro da aposta
                $pontos+= ($bet->result === $bet->pivot->result ? ($betting->score_points + $taxa) : 0);
                $pontos+= ($bet->scoreboard_a === $bet->pivot->scoreboard_a && $bet->scoreboard_b === $bet->pivot->scoreboard_b ? ($betting->extra_points + $taxa) : 0);
              }
            }
          }
          $taxa += $betting->rate_points;
        }

        $betting->current_round = $roundTitle;
        $betting->save();

        $user->myBetting()->updateExistingPivot(
          $betting, [
              'points'=>$pontos
          ]
        );
      }

    }

    public function match($match_id)
    {

      $user = auth()->user();

      $match = $user->matches()->find($match_id);//verifica se o usuario logado já fez a aposta para essa partida

      if($match){
        return $match;
      }

      $match = Match::find($match_id);

      //verificação de segurança, verificar se o apostador pertence ao bolão
      $betting_id = $match->round->betting->id;
      $betting = $user->myBetting()->find($betting_id);
      if($betting){
        return $match;
      }

      return false;
    }

    public function MatchUserSave($match_id, $register){

      $user = auth()->user();

      $match = $user->matches()->find($match_id);//verifica se usuário já fez a aposta

      if(!$match){
        $match = Match::find($match_id);//se não tiver feito, pega um registro novo
      }

        //verificação de segurança, verificar se o apostador pertence ao bolão
        $betting_id = $match->round->betting->id;
        $betting = $user->myBetting()->find($betting_id);

        if($betting){//se existe o bolão e o usuario esta participando dele 

          $result = ($register['scoreboard_a'] > $register['scoreboard_b'] ? 'A' : $register['scoreboard_a'] === $register['scoreboard_b']) ? 'E' : 'B';
        
          $ret = $match->users()->updateExistingPivot($user, 
            ['result' => $result, 'scoreboard_a'=>$register['scoreboard_a'], 'scoreboard_b'=>$register['scoreboard_b']]
          );

          if($ret){

            return $match;

          }else{

            $ret = MatchUser::updateOrCreate(
              ['user_id'=>$user->id, 'match_id'=>$match->id],
              ['result' => $result, 'scoreboard_a'=>$register['scoreboard_a'], 'scoreboard_b'=>$register['scoreboard_b']]
            );
            
          }

          if($ret){
            return $match;
          }
        
        
        }

        return false;

    }



}