<?php

use Illuminate\Database\Seeder;

class ReputationTableSeeder extends Seeder
{

    public function run()
    {
        App\Reputation::create([
            'name' => 'Irresponsable',
            'necesary_score' => -999999]);
        App\Reputation::create([
            'name' => 'Observador',
            'necesary_score' => 0]);
    }

}
