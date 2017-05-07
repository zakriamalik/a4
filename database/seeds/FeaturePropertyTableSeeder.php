<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class FeaturePropertyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

     # leveraged idea about manual seeding from laravel docs: https://laravel.com/docs/5.4/seeding#writing-seeders
     public function run()
     {
         //
         DB::table('feature_property')->insert([
         'created_at' => Carbon\Carbon::now()->toDateTimeString(),
         'updated_at' => Carbon\Carbon::now()->toDateTimeString(),
         'property_id' => 1,
         'feature_id' => 1,
         ]);

         DB::table('feature_property')->insert([
         'created_at' => Carbon\Carbon::now()->toDateTimeString(),
         'updated_at' => Carbon\Carbon::now()->toDateTimeString(),
         'property_id' => 1,
         'feature_id' => 2,
         ]);

         DB::table('feature_property')->insert([
         'created_at' => Carbon\Carbon::now()->toDateTimeString(),
         'updated_at' => Carbon\Carbon::now()->toDateTimeString(),
         'property_id' => 1,
         'feature_id' => 3,
         ]);

         DB::table('feature_property')->insert([
         'created_at' => Carbon\Carbon::now()->toDateTimeString(),
         'updated_at' => Carbon\Carbon::now()->toDateTimeString(),
         'property_id' => 1,
         'feature_id' => 5,
         ]);

         DB::table('feature_property')->insert([
         'created_at' => Carbon\Carbon::now()->toDateTimeString(),
         'updated_at' => Carbon\Carbon::now()->toDateTimeString(),
         'property_id' => 1,
         'feature_id' => 5,
         ]);

         DB::table('feature_property')->insert([
         'created_at' => Carbon\Carbon::now()->toDateTimeString(),
         'updated_at' => Carbon\Carbon::now()->toDateTimeString(),
         'property_id' => 2,
         'feature_id' => 1,
         ]);

         DB::table('feature_property')->insert([
         'created_at' => Carbon\Carbon::now()->toDateTimeString(),
         'updated_at' => Carbon\Carbon::now()->toDateTimeString(),
         'property_id' => 2,
         'feature_id' => 2,
         ]);

           DB::table('feature_property')->insert([
         'created_at' => Carbon\Carbon::now()->toDateTimeString(),
         'updated_at' => Carbon\Carbon::now()->toDateTimeString(),
         'property_id' => 2,
         'feature_id' => 4,
         ]);

         DB::table('feature_property')->insert([
         'created_at' => Carbon\Carbon::now()->toDateTimeString(),
         'updated_at' => Carbon\Carbon::now()->toDateTimeString(),
         'property_id' => 2,
         'feature_id' => 6,
         ]);

         DB::table('feature_property')->insert([
         'created_at' => Carbon\Carbon::now()->toDateTimeString(),
         'updated_at' => Carbon\Carbon::now()->toDateTimeString(),
         'property_id' => 2,
         'feature_id' => 7,
         ]);

         DB::table('feature_property')->insert([
         'created_at' => Carbon\Carbon::now()->toDateTimeString(),
         'updated_at' => Carbon\Carbon::now()->toDateTimeString(),
         'property_id' => 3,
         'feature_id' => 5,
         ]);

         DB::table('feature_property')->insert([
         'created_at' => Carbon\Carbon::now()->toDateTimeString(),
         'updated_at' => Carbon\Carbon::now()->toDateTimeString(),
         'property_id' => 3,
         'feature_id' => 7,
         ]);

         DB::table('feature_property')->insert([
         'created_at' => Carbon\Carbon::now()->toDateTimeString(),
         'updated_at' => Carbon\Carbon::now()->toDateTimeString(),
         'property_id' => 3,
         'feature_id' => 9,
         ]);

         DB::table('feature_property')->insert([
         'created_at' => Carbon\Carbon::now()->toDateTimeString(),
         'updated_at' => Carbon\Carbon::now()->toDateTimeString(),
         'property_id' => 4,
         'feature_id' => 2,
         ]);

         DB::table('feature_property')->insert([
         'created_at' => Carbon\Carbon::now()->toDateTimeString(),
         'updated_at' => Carbon\Carbon::now()->toDateTimeString(),
         'property_id' => 4,
         'feature_id' => 4,
         ]);

         DB::table('feature_property')->insert([
         'created_at' => Carbon\Carbon::now()->toDateTimeString(),
         'updated_at' => Carbon\Carbon::now()->toDateTimeString(),
         'property_id' => 4,
         'feature_id' => 6,
         ]);

         DB::table('feature_property')->insert([
         'created_at' => Carbon\Carbon::now()->toDateTimeString(),
         'updated_at' => Carbon\Carbon::now()->toDateTimeString(),
         'property_id' => 4,
         'feature_id' => 8,
         ]);

         DB::table('feature_property')->insert([
         'created_at' => Carbon\Carbon::now()->toDateTimeString(),
         'updated_at' => Carbon\Carbon::now()->toDateTimeString(),
         'property_id' => 5,
         'feature_id' => 1,
         ]);

         DB::table('feature_property')->insert([
         'created_at' => Carbon\Carbon::now()->toDateTimeString(),
         'updated_at' => Carbon\Carbon::now()->toDateTimeString(),
         'property_id' => 5,
         'feature_id' => 3,
         ]);
     }
}
# Laravel reference docs used for manual seeding. https://laravel.com/docs/5.4/seeding
