<?php

use Illuminate\Database\Seeder;

class AddACLSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admACL = \App\Role::firstOrCreate(['name'=>'SuperAdmin'],
        ['description'=>'Administrador principal do sistema'    
        ]);

        $gerenteACL = \App\Role::firstOrCreate(['name'=>'Gerente'],
        ['description'=>'Gerenciador do sistema'    
        ]);

        //relacionamento user com role
        $userAdmin = \App\User::find(1);
        $userGerente = \App\User::find(2);

        $userAdmin->roles()->attach($admACL);//attach verifica se já não esta relacionado
        $userGerente->roles()->attach($gerenteACL);

        //criar permissão
        $UsersList = \App\Permission::firstOrCreate(['name'=>'users-list'],
        ['description'=>'acesso a lista de usuários'    
        ]);

       // $admACL->permissions()->attach($UsersList);

        
    }
}
