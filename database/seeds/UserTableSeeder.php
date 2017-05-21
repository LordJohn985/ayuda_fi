<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{

    public function run()
    {

        App\User::create([
            'name' => 'admin',
            'last_name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('4dm1n17117'),
            'role_id' => 1,
            'picture'=> '/images/users/default.jpg',
            'phone' => '3570584',
            'born_date' => '1987-07-03'
        ]);
        
        //factory('App\User', 15)->create();

    }

}
