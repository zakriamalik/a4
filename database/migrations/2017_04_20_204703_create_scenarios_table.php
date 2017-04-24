<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateScenariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
            // schema to create & build the table
            Schema::create('scenarios', function (Blueprint $table) {
                    # auto-increment primary key
                		$table->increments('id');
                    # timestamp columns: `created_at` and `updated_at`
                		$table->timestamps();
                		# remaining fields
                    $table->integer('scenario_number');
                    $table->string('scenario_name');
                		$table->decimal('loan_amount');
                		$table->double('interest_rate_annual');
                		$table->double('interest_rate_monthly');
                		$table->string('interest_type');
                		$table->integer('loan_duration_years');
                		$table->integer('loan_duration_months');
                		$table->integer('loan_monthly_payment');
                    $table->decimal('interest_total_paid');
                    $table->double('interest_rate_average');
                    $table->decimal('loan_total_cost');
                    $table->integer('loan_payments_count');

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
            // schema to drop & delete the table
            Schema::drop('scenarios');
    }
}
