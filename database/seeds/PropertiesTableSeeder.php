<?php

use Illuminate\Database\Seeder;
use App\Property;

class PropertiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
     public function run()
     {
         //
         Property::insert([
         'created_at' => Carbon\Carbon::now()->toDateTimeString(),
         'updated_at' => Carbon\Carbon::now()->toDateTimeString(),
         'property_number' => 123456,
         'property_name' => 'EagleRidge 1245',
         'property_address' => '1245 Silverlake Dr, Springfield, TX 78542',
         'property_type' => 'Single Family',
         'property_size' => '3bd-2ba-2ga',
         'living_area' => 1256,
         'lot_size' => 0.35,
         'year_built' => 1985,
         'sale_price' => 119950,
         'tax_rate' => 2.35,
         'hoa_yearly' => 250,
         ]);

         Property::insert([
         'created_at' => Carbon\Carbon::now()->toDateTimeString(),
         'updated_at' => Carbon\Carbon::now()->toDateTimeString(),
         'property_number' => 123457,
         'property_name' => 'Sunset Valley 4578',
         'property_address' => '4578 Garden Parks Dr, Riverfield, TX 76531',
         'property_type' => 'Single Family',
         'property_size' => '4bd-3ba-2ga',
         'living_area' => 2856,
         'lot_size' => 0.41,
         'year_built' => 1994,
         'sale_price' => 265950,
         'tax_rate' => 2.15,
         'hoa_yearly' => 500,
         ]);

         Property::insert([
         'created_at' => Carbon\Carbon::now()->toDateTimeString(),
         'updated_at' => Carbon\Carbon::now()->toDateTimeString(),
         'property_number' => 123458,
         'property_name' => 'Sunrise Place 6584',
         'property_address' => '6584 Moonshine Dr, Nightville, TX 73244',
         'property_type' => 'Townhouse',
         'property_size' => '2bd-2ba-1ga',
         'living_area' => 1050,
         'lot_size' => 0.20,
         'year_built' => 1975,
         'sale_price' => 134999,
         'tax_rate' => 2.20,
         'hoa_yearly' => 150,
         ]);

         Property::insert([
         'created_at' => Carbon\Carbon::now()->toDateTimeString(),
         'updated_at' => Carbon\Carbon::now()->toDateTimeString(),
         'property_number' => 123459,
         'property_name' => 'Forest Creek 1800',
         'property_address' => '1800 Forest Bluff Dr, Jungleville, TX 76612',
         'property_type' => 'Duplex',
         'property_size' => '6bd-4ba-2ga',
         'living_area' => 3125,
         'lot_size' => 0.45,
         'year_built' => 1980,
         'sale_price' => 365950,
         'tax_rate' => 2.52,
         'hoa_yearly' => 750,
         ]);

         Property::insert([
         'created_at' => Carbon\Carbon::now()->toDateTimeString(),
         'updated_at' => Carbon\Carbon::now()->toDateTimeString(),
         'property_number' => 123460,
         'property_name' => 'Westlake Hills 5680-23',
         'property_address' => '5680 Westview Dr, Apt#23, wildwest City, TX 79999',
         'property_type' => 'Appartment',
         'property_size' => '2bd-1ba',
         'living_area' => 875,
         'lot_size' => 0.00,
         'year_built' => 2010,
         'sale_price' => 98590,
         'tax_rate' => 2.65,
         'hoa_yearly' => 750,
         ]);

     }
}
