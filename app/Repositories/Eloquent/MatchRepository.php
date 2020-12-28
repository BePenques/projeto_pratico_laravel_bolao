<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\MatchRepositoryInterface;
use App\Match;

class MatchRepository extends AbstractRepository implements MatchRepositoryInterface
{
    protected $model = Match::class;

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
            return (bool) $register->update($data);
        }else{
            return false;
        }
       
      }else{
        return false;
      }

    
    }


}