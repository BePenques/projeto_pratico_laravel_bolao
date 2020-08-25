<?php

namespace App\Repositories\Eloquent;
use App\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Support\Facades\Hash;
use App\User;


class UserRepository extends AbstractRepository implements UserRepositoryInterface
{
    protected $model = User::class;


    public function create(array $data):Bool
    {
      $data['password'] = Hash::make($data['password']);
      return (bool) $this->model->create($data);
    }

    public function update(array $data, int $id):Bool
    {
      $register = $this->findById($id);
      if($register){
          if($data['password'] ?? false)//se não existir o campo data retorna false
          {
            $data['password'] = Hash::make($data['password']);
          }
        return (bool) $register->update($data);
      }else{
        return false;
      }

    
    }

}


 ?>
