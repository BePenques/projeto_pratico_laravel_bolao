<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         \App\User::firstOrCreate(['name'=>'SuperAdmin'],
        ['email'=>'superadmin@mail.com',
        'password'=>Hash::make('admin123')
        ]);

         \App\User::firstOrCreate(['name'=>'Gerente'],
        ['email'=>'gerente@mail.com',
        'password'=>Hash::make('gerente123')
        ]);
        
    }
}
