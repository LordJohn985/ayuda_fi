<?php

use Illuminate\Database\Seeder;

class ReputationTableSeeder extends Seeder
{

    public function run()
    {
        App\Reputation::create([
            'name' => 'Mal tipo',
            'necesary_score' => -999999]);
        App\Reputation::create([
            'name' => 'Tipo normal',
            'necesary_score' => 0]);
        App\Reputation::create([
            'name' => 'Buen tipo',
            'necesary_score' => 1]);
    }

}
