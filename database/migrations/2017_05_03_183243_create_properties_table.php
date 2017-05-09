<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
            // schema to create & build the table
            Schema::create('properties', function (Blueprint $table) {
                    # auto-increment primary key
                    $table->increments('id');
                    # timestamp columns: `created_at` and `updated_at`
                    $table->timestamps();
                    # remaining fields
                    $table->integer('property_number');
                    $table->string('property_name');
                    $table->text('property_address');
                    $table->string('property_type');
                    $table->string('property_size');
                    $table->integer('living_area');
                    $table->double('lot_size');
                    $table->integer('year_built');
                    $table->double('sale_price');
                    $table->double('tax_rate');
                    $table->double('hoa_yearly');
                    # FYI: We're skipping the 'tags' field for now; more on that later.

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
        Schema::drop('properties');
    }
}
