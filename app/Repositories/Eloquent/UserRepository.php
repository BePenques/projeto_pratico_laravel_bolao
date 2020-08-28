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
      $register = $this->model->create($data);
      if(isset($data['roles']) && count($data['roles'])){
        foreach($data['roles'] as $key => $value){
            $register->roles()->attach($value);//attach - relaciona  um elemento com outro
        }
      }

      return (bool) $register;
    }

    public function update(array $data, int $id):Bool
    {
      $register = $this->findById($id);

      // if (!$register->can('edit-user')) {
      //   return false;
      // }

      if($register){
          if($data['password'] ?? false)//se não existir o campo data retorna false
          {
            $data['password'] = Hash::make($data['password']);
          }

          $this->removeRoles($register);//remove as permissoes antigas pra colocar as novas selecionadas

          if(isset($data['roles']) && count($data['roles'])){
              foreach($data['roles'] as $key => $value){
                  $register->roles()->attach($value);//attach - relaciona  um elemento com outro
              }
          }

        return (bool) $register->update($data);
      }else{
        return false;
      }

    }

    public function removeRoles($register)
    {
        $roles = $register->roles;
        if(count($roles)){
            foreach($roles as $key => $value){
                $register->roles()->detach($value->id);//detach - remove o relacionamento
            }
        }
    }


}


 ?>
