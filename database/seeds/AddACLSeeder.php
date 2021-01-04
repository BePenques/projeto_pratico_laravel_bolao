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

        //permissao para visualizar a lista de usuarios
        $UsersList = \App\Permission::firstOrCreate(['name'=>'users-list'],
        ['description'=>'acesso a lista de usuários'    
        ]);

        //permissao para criar usuario
        $CreateUsers = \App\Permission::firstOrCreate(['name'=>'create-users'],
        ['description'=>'acesso a criar usuário'    
        ]);
        //permissao para ver detalhes do usuario
        $ShowUsers = \App\Permission::firstOrCreate(['name'=>'show-users'],
        ['description'=>'acesso a ver detalhes do usuário'    
        ]);
         //permissao para editar usuario
        $EditUsers = \App\Permission::firstOrCreate(['name'=>'edit-users'],
        ['description'=>'acesso a editar usuário'    
        ]);
         //permissao para deletar usuario
        $DeleteUsers = \App\Permission::firstOrCreate(['name'=>'delete-users'],
        ['description'=>'acesso a deletar usuário'    
        ]);

        $acessoBetting = \App\Permission::firstOrCreate(['name'=>'manage-bets'],
        ['description'=>'acesso a todos os bolões de todos os usuários'    
        ]);

        $FullPermission = \App\Permission::firstOrCreate(['name'=>'acl-full-permission'],
        ['description'=>'acesso a todas as permissoes do sistema'    
        ]);
   

        //relacionamewnto role com permissions

        $gerenteACL->permissions()->attach($UsersList);
        $gerenteACL->permissions()->attach($CreateUsers);

        
    }
}
