<?php

use Illuminate\Database\Seeder;

class ConfigurationTableSeeder extends Seeder
{

    public function run()
    {
        App\Configuration::create(['price' => 1]);
    }

}
