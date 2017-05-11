{{-- /resources/views/scenario/view.blade.php --}}
{{-- blade view to show a single loan scenario saved in the database in read-only mode; also connects the property listing and property features using table joins --}}

@extends('layouts.master')

@section('title')
        View a single Mortgage Loan Scenario
@endsection

@section('form_content')
  <h2>View a Mortgage Scenario Information saved in the Database</h2>
        <!--start of form using GET method -->
    <Form method='GET' action='/scenario/view' id='formView'>
        <h3> Loan Scenario Information </h3>
        <!--hidden number input box for loading up the loan scenario using id autogenerated by the database-->
        <input type='hidden' name='id' value='{{$scenario->id}}' disabled>
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
        <label for='loanTotalPayments'>Total Loan Payments ($):</label>
        <input type='number' id='loanTotalPayments' name='loanTotalPayments' value= '{{$scenario->loan_payments_count}}' disabled><br/>

        <!--Start of Property Information Section tied to the loan scenario-->
        <h3> Loan Scenario for following Real Estate Property </h3>
        <!--Forzen select dropdown showing the prperty tied to the scenario -->
        <label for='propertySelect'>Property Name:</label>
        <select name='propertySelect' id='propertySelect' disabled>
          <option value='0'>Choose</option>
            @foreach($properties as $properties)
            <option value='{{$properties->id}}' {{ $scenario->property_id == $properties->id ? 'Selected' : '' }}>{{$properties->property_name}}</option>
            @endforeach
        </select><br/>
        <!-- read only text box for Property Address -->
        <label for='propertyAddress'>Property Address:</label>
        <input type='text' id='propertyAddress' name='propertyAddress' value= '{{$properties->property_address}}' size='50' disabled><br/>
        <!-- read only text box for Property Type -->
        <label for='propertyType'>Property Type: </label>
        <input type='text' id='propertyType' name='propertyType' value= '{{$properties->property_type}}' disabled><br/>
        <!-- read only text box for Property Size -->
        <label for='propertySize'>Property Size: </label>
        <input type='text' id='propertySize' name='propertySize' value= '{{$properties->property_size}}' disabled><br/>
        <!-- read only number box for Property Living Space -->
        <label for='livingArea'>Property Living Space (sqft): </label>
        <input type='number' id='livingArea' name='livingArea' value= '{{$properties->living_area}}' disabled><br/>
        <!-- read only number box for Property Lot Size -->
        <label for='lotSize'>Property Lot Size (acres): </label>
        <input type='number' id='lotSize' name='lotSize' value= '{{$properties->lot_size}}' disabled><br/>
        <!-- read only number box for Property Year Built -->
        <label for='yearBuilt'>Property Year Built: </label>
        <input type='number' id='yearBuilt' name='yearBuilt' value= '{{$properties->year_built}}' disabled><br/>
        <!-- read only number box for Property Sale Price -->
        <label for='salePrice'>Property Sale Price ($): </label>
        <input type='number' id='salePrice' name='salePrice' value= '{{round($properties->sale_price,2)}}' disabled><br/>
        <!-- read only number box for Property Tax Rate -->
        <label for='taxRate'>Property Tax Rate (%): </label>
        <input type='number' id='taxRate' name='taxRate' value= '{{round($properties->tax_rate,3)}}' disabled><br/>
        <!-- read only number box for Property Yearly HOA -->
        <label for='hoaYearly'>Property Yearly HOA ($): </label>
        <input type='number' id='hoaYearly' name='hoaYearly' value= '{{round($properties->hoa_yearly,2)}}' disabled><br/>
        <!-- read only number box to show Estimated Down Payment -->
        <label for='estDownPmt'>Estimated Down Payment ($): </label>
        <input type='number' id='estDownPmt' name='estDownPmt' value= '{{$properties->sale_price-$scenario->loan_amount>0 ? round($properties->sale_price,2) - round($scenario->loan_amount,2) : 0}}' disabled><br/>

        <!-- feature ul list using forelse loop to extract property features using pivot table -->
        <label>Key Features</label>
        <ul id='features'>
            @forelse($features as $feature)
                <li>{{ $feature->feature_name }}</li>
            @empty
                {{'No features found for this property'}}
            @endforelse
        </ul>
        {{-- Reference: Leveraged class lecture notes for extracting info using pivot table -> https://github.com/susanBuck/foobooks/blob/master/resources/views/books/edit.blade.php --}}
        {{-- Reference: Leveraged stackoverflow for using @forelse loop -> http://stackoverflow.com/questions/32652818/laravel-blade-check-empty-foreach --}}

        {{-- <!--checkbox to show or hide loan cost and amortization table -->
        <label><input type='checkbox' name='show_table' value='show_table' onclick='return check()' {{ isset($_GET['show_table']) ? 'checked' : ''}} {{old('show_table') ? 'checked' : ''}}> Display Amortization Table</label><br/>
        <!--Reference: Technique used based on method used on this website:
        http://stackoverflow.com/questions/12541419/php-keep-checkbox-checked-after-submitting-form--> --}}


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

            {{-- Add another director <input type="checkbox" id="checkbox1"/> --}}
            {{-- <div id="autoUpdate" class="autoUpdate">
                <hr>
                  <div>
                    <h3>Mortgage Amortization Schedule</h3>
                    @include('amortTbl');
                  </div>
            </div> --}}
@endsection
