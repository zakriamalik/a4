<?php

use Illuminate\Database\Seeder;
use App\Feature;

class FeaturesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
            //
            Feature::insert([
            'created_at' => Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon\Carbon::now()->toDateTimeString(),
            'feature_number' => 111,
            'feature_name' => 'Covered Patio',
            ]);

            Feature::insert([
            'created_at' => Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon\Carbon::now()->toDateTimeString(),
            'feature_number' => 112,
            'feature_name' => 'High Ceiling',
            ]);

            Feature::insert([
            'created_at' => Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon\Carbon::now()->toDateTimeString(),
            'feature_number' => 113,
            'feature_name' => 'Private Fence',
            ]);
            Feature::insert([
            'created_at' => Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon\Carbon::now()->toDateTimeString(),
            'feature_number' => 114,
            'feature_name' => 'Stainless Steel Appliances',
            ]);

            Feature::insert([
            'created_at' => Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon\Carbon::now()->toDateTimeString(),
            'feature_number' => 115,
            'feature_name' => 'Hardwood Floors',
            ]);

            Feature::insert([
            'created_at' => Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon\Carbon::now()->toDateTimeString(),
            'feature_number' => 116,
            'feature_name' => 'Storage Shed',
            ]);

            Feature::insert([
            'created_at' => Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon\Carbon::now()->toDateTimeString(),
            'feature_number' => 117,
            'feature_name' => 'Home Security System',
            ]);

            Feature::insert([
            'created_at' => Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon\Carbon::now()->toDateTimeString(),
            'feature_number' => 118,
            'feature_name' => 'Pool',
            ]);

            Feature::insert([
            'created_at' => Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon\Carbon::now()->toDateTimeString(),
            'feature_number' => 119,
            'feature_name' => 'Granite Countertops',
            ]);

            Feature::insert([
            'created_at' => Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon\Carbon::now()->toDateTimeString(),
            'feature_number' => 120,
            'feature_name' => 'Fire pit',
            ]);

    }
}
