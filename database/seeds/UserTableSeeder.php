<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class UserTableSeeder extends Seeder
{

    public function run()
    {

        App\User::create([
            'name' => 'admin',
            'last_name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('123'),
            'role_id' => 1,
            'picture'=> '/images/users/default.jpg',
            'phone' => '3570584',
            'born_date' => '1987-07-03'
        ]);
        App\User::create([
            'name' => 'usuario1',
            'last_name' => 'tester1',
            'email' => 'test1@test1.com',
            'password' => bcrypt('123'),
            'role_id' => 2,
            'picture'=> '/images/users/default.jpg',
            'phone' => '3570584',
            'born_date' => '1987-07-03'
        ]);
        App\User::create([
            'name' => 'usuario2',
            'last_name' => 'tester2',
            'email' => 'test2@test2.com',
            'password' => bcrypt('123'),
            'role_id' => 2,
            'picture'=> '/images/users/default.jpg',
            'phone' => '3570584',
            'born_date' => '1987-07-03'
        ]);
        App\User::create([
            'name' => 'usuario3',
            'last_name' => 'tester3',
            'email' => 'test3@test3.com',
            'password' => bcrypt('123'),
            'role_id' => 2,
            'picture'=> '/images/users/default.jpg',
            'phone' => '3570584',
            'born_date' => '1987-07-03'
        ]);
        App\User::create([
            'name' => 'usuario4',
            'last_name' => 'tester4',
            'email' => 'test4@test4.com',
            'password' => bcrypt('123'),
            'role_id' => 2,
            'picture'=> '/images/users/default.jpg',
            'phone' => '3570584',
            'born_date' => '1987-07-03'
        ]);
        App\User::create([
            'name' => 'usuario5',
            'last_name' => 'tester5',
            'email' => 'test5@test5.com',
            'password' => bcrypt('123'),
            'role_id' => 2,
            'picture'=> '/images/users/default.jpg',
            'phone' => '3570584',
            'born_date' => '1987-07-03'
        ]);
        App\User::create([
            'name' => 'usuario6',
            'last_name' => 'tester6',
            'email' => 'test6@test6.com',
            'password' => bcrypt('123'),
            'role_id' => 2,
            'picture'=> '/images/users/default.jpg',
            'phone' => '3570584',
            'born_date' => '1987-07-03'
        ]);
        App\User::create([
            'name' => 'usuario7',
            'last_name' => 'tester7',
            'email' => 'test7@test7.com',
            'password' => bcrypt('123'),
            'role_id' => 2,
            'picture'=> '/images/users/default.jpg',
            'phone' => '3570584',
            'born_date' => '1987-07-03'
        ]);
        App\User::create([
            'name' => 'usuario8',
            'last_name' => 'tester8',
            'email' => 'test8@test8.com',
            'password' => bcrypt('123'),
            'role_id' => 2,
            'picture'=> '/images/users/default.jpg',
            'phone' => '3570584',
            'born_date' => '1987-07-03'
        ]);
        App\User::create([
            'name' => 'usuario9',
            'last_name' => 'tester9',
            'email' => 'test9@test9.com',
            'password' => bcrypt('123'),
            'role_id' => 2,
            'picture'=> '/images/users/default.jpg',
            'phone' => '3570584',
            'born_date' => '1987-07-03'
        ]);
        App\User::create([
            'name' => 'usuario10',
            'last_name' => 'tester10',
            'email' => 'test10@test10.com',
            'password' => bcrypt('123'),
            'role_id' => 2,
            'picture'=> '/images/users/default.jpg',
            'phone' => '3570584',
            'born_date' => '1987-07-03'
        ]);
        App\User::create([
            'name' => 'usuario11',
            'last_name' => 'tester11',
            'email' => 'test11@test11.com',
            'password' => bcrypt('123'),
            'role_id' => 2,
            'credits' => 15,
            'picture'=> '/images/users/default.jpg',
            'phone' => '3570584',
            'born_date' => '1987-07-03'
        ]);
        App\User::create([
            'name' => 'usuario12',
            'last_name' => 'tester12',
            'email' => 'test12@test12.com',
            'password' => bcrypt('123'),
            'role_id' => 2,
            'credits' => 0,
            'picture'=> '/images/users/default.jpg',
            'phone' => '3570584',
            'born_date' => '1987-07-03'
        ]);
        App\User::create([
            'name' => 'usuario13',
            'last_name' => 'tester13',
            'email' => 'test13@test13.com',
            'password' => bcrypt('123'),
            'role_id' => 2,
            'credits' => 15,
            'picture'=> '/images/users/default.jpg',
            'phone' => '3570584',
            'born_date' => '1987-07-03'
        ]);
        App\User::create([
            'name' => 'usuario14',
            'last_name' => 'tester14',
            'email' => 'test14@test14.com',
            'password' => bcrypt('123'),
            'role_id' => 2,
            'score' => 3,
            'credits' => 2,
            'picture'=> '/images/users/default.jpg',
            'phone' => '3570584',
            'born_date' => '1987-07-03'
        ]);
        App\User::create([
            'name' => 'usuario',
            'last_name' => 'borrado',
            'email' => 'usuario@borrado.com',
            'password' => bcrypt('123'),
            'role_id' => 2,
            'picture'=> '/images/users/default.jpg',
            'phone' => '3570584',
            'born_date' => '1987-07-03',
            'deleted_at' => Carbon::now()
        ]);
        //factory('App\User', 20)->create();

    }

}
