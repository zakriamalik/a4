<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFeaturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('features', function (Blueprint $table) {
        # auto-increment primary key
        $table->increments('id');
        # timestamp columns: `created_at` and `updated_at`
        $table->timestamps();
        # remaining fields
        $table->integer('feature_number');
        $table->string('feature_name');
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
      Schema::drop('features');
    }
}
