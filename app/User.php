<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function bettings()
    {
        return $this->hasMany('App\Betting');
    }

    public function matches()
    {
        return $this->belongsToMany('App\Match');
    }

    public function getRoundsAttribute(){//pegar os rounds que pertencem ao bolão

        $bettings = $this->bettings;//lista de bolões desse usuário
        $rounds = [];

        foreach ($bettings as $key => $value) {
            $rounds[]= $value->rounds;
        }

        return Arr::collapse($rounds);//agrupa todos os rounds em uma unica chave(sem separar por bolão)

        //Exemplo: $array = Arr::collapse([[1, 2, 3], [4, 5, 6], [7, 8, 9]]);
        // resultado: [1, 2, 3, 4, 5, 6, 7, 8, 9]
    }

    public function roles()
    {
        return $this->belongsToMany('App\Role');
    }

    public function hasRoles($roles)
    {

        $userRoles = $this->roles;//retorna a lista de funçoes/papeis desse usuário

        return $roles->intersect($userRoles)->count();
    //compara se uma lista tem elementos parecidos com da outra lista
    //compara a lista de papeis do usuario com a lista de funçoes relaciondas a determinada permissao
    }

    public function isSuperAdmin()
    {
        return $this->hasRole("SuperAdmin");
    }


    public function hasRole($role)
    {

       if(is_string($role)){//se for string transforma em objecto
          
            $role = Role::where('name','=',$role)->firstOrFail();

       }

        return (boolean) $this->roles()->find($role->id);//procura nos papeis do usuario se tem o id de SuperAdmin
      
    }

    public function myBetting()
    {
        return $this->belongsToMany('App\Betting');
    }
}
