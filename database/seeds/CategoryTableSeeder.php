<?php

use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{

    public function run()
    {
        App\Category::create(['name' => 'dinero']);
        App\Category::create(['name' => 'amor']);
        App\Category::create(['name' => 'suerte']);
        App\Category::create(['name' => 'autos']);
        App\Category::create(['name' => 'viajes']);
        App\Category::create(['name' => 'intenieria']);
        App\Category::create(['name' => 'mascotas']);
    }
}
