<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFeaturePropertyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up()
     {
         //
         Schema::create('feature_property', function (Blueprint $table) {

         $table->increments('id');
         $table->timestamps();

         # `property_id` and `feature_id` will be foreign keys, so they have to be unsigned
         #  Note how the field names here correspond to the tables they will connect...
         # `property_id` will reference the `properties table` and `feature_id` will reference the `features` table.
         $table->integer('property_id')->unsigned();
         $table->integer('feature_id')->unsigned();

         # Make foreign keys
         $table->foreign('property_id')->references('id')->on('properties');
         $table->foreign('feature_id')->references('id')->on('features');

     });
     }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
