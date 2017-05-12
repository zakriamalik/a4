{{-- /resources/views/scenario/remove.blade.php --}}
{{-- blade view to remove a new loan scenario to the database; leveraged code from class notes http://dwa15.com --}}

@extends('layouts.master')

@section('title')
    Remove Mortgage Loan Scenario
@endsection

@section('form_content')
 <h2>Remove a Mortgage Loan Scenario Information from the Database</h2>

   <h3>Confirm deletion</h3>
      <!--start of form -->
       <form method='POST' action='/scenario/remove'>
            <!--CSRF protection code -->
           {{ csrf_field() }}
            <!--hidden input number field to track the scenario -->
           <input type='hidden' name='id' value='{{ $scenario->id }}'>
           <!--number input box for loan scenario number maintained by the user-->
           <label for='scenarioNumber'>Loan Scenario Number:</label>
           <input type='number' id='scenarioNumber' name='scenarioNumber' value= '{{$scenario->scenario_number}}' disabled><br/>
           <!--text input box for loan scenario name to be maintained by the user for identifying the scenario visually-->
           <label for='scenarioName'>Loan Scenario Name:</label>
           <input type='text' id='scenarioName' name='scenarioName' value= '{{$scenario->scenario_name}}' disabled><br/>
           <!--number input box for loan amount entry -->
           <label for='loan'>Loan Amount ($):</label>
           <input type='number' id='loan' name='loan' value= '{{round($scenario->loan_amount,2)}}' disabled><br/>
           <!--number input box for interest rate entry -->
           <label for='interestRateAnnual'>Interest Rate Annual (%):</label>
           <input type='number' id='interestRateAnnual' name='interestRateAnnual' value= '{{round($scenario->interest_rate_annual,3)}}' disabled><br/>
           <!--Reference: Information leveraged to retain data in textboxes
            https://laracasts.com/discuss/channels/laravel/input-data-not-remaining-after-refresh-using-old?page=1-->
           <!--frozen option radio buttons for chosing the type of interest rate -->
           <b>Interest Type:</b>
           <label><input type='radio' name='interestType' value='fixed' {{$scenario->interest_type=='fixed' ? 'checked' : ''}} disabled> Fixed</label>
           <label><input type='radio' name='interestType' value='variable' {{$scenario->interest_type=='variable'  ? 'checked' : ''}} disabled> Variable</label><br/>
           <!--Reference: Information leveraged to retain option boxes checked
           https://laracasts.com/discuss/channels/laravel/sex-radio-input-options-old-input-->

           <!--frozen select downdown for selecting the duration of loan in years -->
           <label for='loanDurationYears'>Select loan duration: </label>
           <select name='loanDurationYears' id='loanDurationYears' disabled>
             <option value=''> Select one </option>
             <option value='15' {{$scenario->loan_duration_years=='15' ? 'Selected' : ''}} > 15 yrs</option>
             <option value='20' {{$scenario->loan_duration_years=='20' ? 'Selected' : ''}} > 20 yrs</option>
             <option value='25' {{$scenario->loan_duration_years=='25' ? 'Selected' : ''}} > 25 yrs</option>
             <option value='30' {{$scenario->loan_duration_years=='30' ? 'Selected' : ''}} > 30 yrs</option>
             <option value='35' {{$scenario->loan_duration_years=='35' ? 'Selected' : ''}} > 35 yrs</option>
             <option value='40' {{$scenario->loan_duration_years=='40' ? 'Selected' : ''}} > 40 yrs</option>
           </select><br/>

           <!-- read only number box for interest rate monthly entry -->
           <label for='interestRateMonthly'>Interest Rate Monthly (%):</label>
           <input type='number' id='interestRateMonthly' name='interestRateMonthly' value= {{round($scenario->interest_rate_monthly,3)}} disabled><br/>
           <!-- read only number box for loan duration months -->
           <label for='loanDurationMonthly'>Loan Duration Months:</label>
           <input type='number' id='loanDurationMonthly' name='loanDurationMonthly' value= '{{$scenario->loan_duration_months}}' disabled> <br/>
           <!-- read only number box for loan monthly payment -->
           <label for='loanMonthlyPayment'>Loan Monthly Payment ($):</label>
           <input type='number' id='loanMonthlyPayment' name='loanMonthlyPayment' value= '{{round($scenario->loan_monthly_payment,2)}}' disabled><br/>
           <!-- read only number box total interest paid -->
           <label for='interestTotalPaid'>Total Interest Paid ($):</label>
           <input type='number' id='interestTotalPaid' name='interestTotalPaid' value= '{{round($scenario->interest_total_paid,2)}}' disabled><br/>
           <!-- read only number box for avg interest rate -->
           <label for='interestRateAvg'>Average Monthly Interest Rate (%):</label>
           <input type='number' id='interestRateAvg' name='interestRateAvg' value= '{{round($scenario->interest_rate_average,3)}}' disabled><br/>
           <!-- read only number box for total loan cost -->
           <label for='loanTotalCost'>Total Loan Cost ($):</label>
           <input type='number' id='loanTotalCost' name='loanTotalCost' value= '{{round($scenario->loan_total_cost,2)}}' disabled><br/>
           <!-- read only number box for total loan payments -->
           <label for='loantotalPayments'>Total Loan Payments ($):</label>
           <input type='number' id='loanTotalPayments' name='loanTotalPayments' value= '{{$scenario->loan_payments_count}}' disabled><br/>


          <!--Confirmation message for removal of record -->
           <h2>Are you sure you want to remove this scenario from the database <em>{{ $scenario->scenario_name }}</em>?</h2>
           <!--submit button to remove -->
           <input type='submit' value='Confirm Remove' class='btn btn-danger'>

       </form>

@endsection


@section('error_content')
  <!--blade template placeholder section, satisfies html validator requirements -->
    <h6>&nbsp;</h6>
@endsection

@section('mortcalc_content')
  <!--blade template placeholder section, satisfies html validator requirements -->
    <h6>&nbsp;</h6>
@endsection

@section('loancost_content')
  <!--blade template placeholder section, satisfies html validator requirements -->
    <h6>&nbsp;</h6>
@endsection

@section('amorttbl_content')
  <!--blade template placeholder section, satisfies html validator requirements -->
    <h6>&nbsp;</h6>
@endsection
