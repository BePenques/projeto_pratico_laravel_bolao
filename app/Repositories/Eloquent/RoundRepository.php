<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\RoundRepositoryInterface;
use App\Round;

class RoundRepository extends AbstractRepository implements RoundRepositoryInterface
{
    protected $model = Round::class;

    public function create(array $data):Bool
    {

        $user = auth()->user();
        $listRel = $user->bettings;
        $betting_id = $data['betting_id'];
        $exist = false;

        foreach ($listRel as $key => $value) {
           if($betting_id == $value->id){
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
        $listRel = $user->bettings;
        $betting_id = $data['betting_id'];
        $exist = false;
    
        foreach ($listRel as $key => $value) {/*verifica se o registro pertence a determinado usuário*/
           if($betting_id == $value->id){
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