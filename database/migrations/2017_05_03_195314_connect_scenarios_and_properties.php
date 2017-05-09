<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ConnectScenariosAndProperties extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up()
     {
         Schema::table('scenarios', function (Blueprint $table) {
     		    # property_number is a foreign key that joins the two tables together
            $table->foreign('property_id')->references('id')->on('properties');

         });
     }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
     public function down()
     {
         Schema::table('scenarios', function (Blueprint $table) {

             # ref: http://laravel.com/docs/migrations#dropping-indexes
             # combine tablename + fk field name + the word "foreign"
             $table->dropForeign('scenarios_property_id_foreign');

         });
     }
}
