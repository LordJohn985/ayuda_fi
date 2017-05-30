<?php

use Illuminate\Database\Seeder;

class LabelTableSeeder extends Seeder
{

    public function run()
    {
        App\Label::create(['name' => 'sin calificar']);
        App\Label::create(['name' => 'negativo']);
        App\Label::create(['name' => 'neutral']);
        App\Label::create(['name' => 'positivo']);
    }

}
