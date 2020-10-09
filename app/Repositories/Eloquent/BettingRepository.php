<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\BettingRepositoryInterface;
use App\Betting;

class BettingRepository extends AbstractRepository implements BettingRepositoryInterface
{
    protected $model = Betting::class;

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




}