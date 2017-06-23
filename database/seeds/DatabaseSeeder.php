<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RoleTableSeeder::class);
        $this->call(UserTableSeeder::class);
        $this->call(CategoryTableSeeder::class);
        $this->call(CityTableSeeder::class);
        $this->call(LabelTableSeeder::class);
        $this->call(ReputationTableSeeder::class);
        $this->call(PublicationTableSeeder::class);
        $this->call(CalificationTableSeeder::class);
        $this->call(PostulationTableSeeder::class);
        $this->call(ConfigurationTableSeeder::class);
    }
}
