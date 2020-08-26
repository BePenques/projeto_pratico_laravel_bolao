<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\RoleRepositoryInterface;
use App\Role;

class RoleRepository extends AbstractRepository implements RoleRepositoryInterface
{
    protected $model = Role::class;

    public function create(array $data):Bool
    {
      $register = $this->model->create($data);
      if(isset($data['permissions']) && count($data['permissions'])){
        foreach($data['permissions'] as $key => $value){
            $register->permissions()->attach($value);//attach - relaciona  um elemento com outro
        }
      }
      return (bool) $register;
    }

    public function update(array $data, int $id):Bool
    {
      $register = $this->findById($id);
      if($register){

        $this->removePermissions($register);//remove as permissoes antigas pra colocar as novas selecionadas

        if(isset($data['permissions']) && count($data['permissions'])){
            foreach($data['permissions'] as $key => $value){
                $register->permissions()->attach($value);//attach - relaciona  um elemento com outro
            }
        }
        return (bool) $register->update($data);

      }else{

        return false;
      }

    
    }

    public function removePermissions($register)
    {
        $permissions = $register->permissions;
        if(count($permissions)){
            foreach($permissions as $key => $value){
                $register->permissions()->detach($value->id);//detach - remove o relacionamento
            }
        }
    }



}
