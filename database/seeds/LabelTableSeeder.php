<?php

use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{

    public function run()
    {
        App\Category::create(['name' => 'sin calificar']);
        App\Category::create(['name' => 'negativo']);
        App\Category::create(['name' => 'neutral']);
        App\Category::create(['name' => 'positivo']);
    }

}
