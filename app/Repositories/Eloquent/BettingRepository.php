<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\BettingRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use App\Betting;

class BettingRepository extends AbstractRepository implements BettingRepositoryInterface
{
    protected $model = Betting::class;

    public function list():Collection
    {
       $list =  Betting::all();
       $user = Auth()->user();

       if($user){

          $myBetting = $user->myBetting;

          foreach ($list as $key => $value) {
              if($myBetting->contains($value)){
                $value->subscriber = true;
              }
          }

       }

       return $list;
    }

    public function create(array $data):Bool
    {
        $user = Auth()->user();
        $data['user_id'] = $user->id;
        return (bool) $this->model->create($data);
    }

    public function update(array $data, int $id):Bool
    {
        $register = $this->findById($id);
        if($register){
          $user = Auth()->user();
          $data['user_id'] = $user->id;
          return (bool) $register->update($data);
        }else{
          return false;
        }
    }

    public function BettingUser($id){

      $user = Auth()->user();
      $betting = Betting::find($id);
      if($betting){
        $rel = $user->myBetting()->toggle($betting->id);
        /*toggle - se o usuario estiver relacionado com betting, ele remove a relação 
         se não tiver relacionado, ele vai criar essa relação */
         if(count($rel['attached'])){//se estiver relacionado
           return true;
         }
      }

      return false;
      
    }




}
