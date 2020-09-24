<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

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
}
