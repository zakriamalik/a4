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
        // $this->call(UsersTableSeeder::class);

        $this->call(PropertiesTableSeeder::class);
        $this->call(ScenariosTableSeeder::class);
        $this->call(FeaturesTableSeeder::class);
        $this->call(FeaturePropertyTableSeeder::class);
    }
}
