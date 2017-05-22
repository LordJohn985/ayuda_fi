<?php

use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{

    public function run()
    {
        App\Category::create(['name' => 'testing']);
    }

}
