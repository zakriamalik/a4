<?php

use Illuminate\Database\Seeder;
use App\Scenario;

class ScenariosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Scenario::insert([
        'created_at' => Carbon\Carbon::now()->toDateTimeString(),
        'updated_at' => Carbon\Carbon::now()->toDateTimeString(),
        'scenario_number' => 1,
        'scenario_name' => 'alpha',
        'loan_amount' => 100000,
        'interest_rate_annual' => 4.0,
        'interest_rate_monthly' => 0.333,
        'interest_type' => 'fixed',
        'loan_duration_years' => 20,
        'loan_duration_months' => 240,
        'loan_monthly_payment' => 605.98,
        'interest_total_paid' => 45101.86,
        'interest_rate_average' => 0.333,
        'loan_total_cost' => 145101.86,
        'loan_payments_count' => 240,
        'property_id' => 1,
        ]);

        Scenario::insert([
        'created_at' => Carbon\Carbon::now()->toDateTimeString(),
        'updated_at' => Carbon\Carbon::now()->toDateTimeString(),
        'scenario_number' => 2,
        'scenario_name' => 'beta',
        'loan_amount' => 100000,
        'interest_rate_annual' => 4.0,
        'interest_rate_monthly' => 0.333,
        'interest_type' => 'fixed',
        'loan_duration_years' => 30,
        'loan_duration_months' => 360,
        'loan_monthly_payment' => 659.96,
        'interest_total_paid' => 71536.18,
        'interest_rate_average' => 0.333,
        'loan_total_cost' => 171536.18,
        'loan_payments_count' => 360,
        'property_id' => 1,
        ]);

        Scenario::insert([
        'created_at' => Carbon\Carbon::now()->toDateTimeString(),
        'updated_at' => Carbon\Carbon::now()->toDateTimeString(),
        'scenario_number' => 3,
        'scenario_name' => 'gamma',
        'loan_amount' => 100000,
        'interest_rate_annual' => 5.0,
        'interest_rate_monthly' => 0.417,
        'interest_type' => 'fixed',
        'loan_duration_years' => 30,
        'loan_duration_months' => 360,
        'loan_monthly_payment' => 536.82,
        'interest_total_paid' => 92838.95,
        'interest_rate_average' => 0.417,
        'loan_total_cost' => 192838.95,
        'loan_payments_count' => 360,
        'property_id' => 3,
        ]);

        Scenario::insert([
        'created_at' => Carbon\Carbon::now()->toDateTimeString(),
        'updated_at' => Carbon\Carbon::now()->toDateTimeString(),
        'scenario_number' => 4,
        'scenario_name' => 'delta',
        'loan_amount' => 200000,
        'interest_rate_annual' => 4.0,
        'interest_rate_monthly' => 0.333,
        'interest_type' => 'fixed',
        'loan_duration_years' => 20,
        'loan_duration_months' => 240,
        'loan_monthly_payment' => 1211.96,
        'interest_total_paid' => 90204.01,
        'interest_rate_average' => 0.333,
        'loan_total_cost' => 290204.01,
        'loan_payments_count' => 240,
        'property_id' => 2,
        ]);

        Scenario::insert([
        'created_at' => Carbon\Carbon::now()->toDateTimeString(),
        'updated_at' => Carbon\Carbon::now()->toDateTimeString(),
        'scenario_number' => 5,
        'scenario_name' => 'omega',
        'loan_amount' => 250000,
        'interest_rate_annual' => 4.0,
        'interest_rate_monthly' => 0.333,
        'interest_type' => 'fixed',
        'loan_duration_years' => 30,
        'loan_duration_months' => 360,
        'loan_monthly_payment' => 954.83,
        'interest_total_paid' => 143072.39,
        'interest_rate_average' => 0.333,
        'loan_total_cost' => 343072.39,
        'loan_payments_count' => 360,
        'property_id' => 2,
        ]);

        Scenario::insert([
        'created_at' => Carbon\Carbon::now()->toDateTimeString(),
        'updated_at' => Carbon\Carbon::now()->toDateTimeString(),
        'scenario_number' => 6,
        'scenario_name' => 'theta',
        'loan_amount' => 200000,
        'interest_rate_annual' => 5.0,
        'interest_rate_monthly' => 0.417,
        'interest_type' => 'fixed',
        'loan_duration_years' => 30,
        'loan_duration_months' => 360,
        'loan_monthly_payment' => 1073.64,
        'interest_total_paid' => 185678.21,
        'interest_rate_average' => 0.417,
        'loan_total_cost' => 385678.21,
        'loan_payments_count' => 360,
        'property_id' => 5,
        ]);

    }
}
