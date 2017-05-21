<?php

use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{

    public function run()
    {
        App\Role::create(['name' => 'Admin']);
        App\Role::create(['name' => 'CommonUser']);
    }

}
