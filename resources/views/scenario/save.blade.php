{{-- /resources/views/scenario/save.blade.php --}}
{{-- blade view to save a new loan scenario to the database; also connects the property listing using table joins --}}

@extends('layouts.master')

@section('title')
    Save a new Mortgage Loan Scenario
@endsection

@section('form_content')
  <h2>Save Mortgage Loan Scenario to Database</h2>
  <!--start of form -->
  <Form method='POST' action='/scenario/save' id='formMort'>
        <!--CSRF protection code -->
        {{ csrf_field() }}
        <!--text input box for loan scenario number -->
        <label for='scenarioNumber'>Loan Scenario Number:*</label>
        <input type='number' id='scenarioNumber' step='1' min='1' name='scenarioNumber'
        title='User friendly number for identification, max number=100000000'
        value= '{{ isset($_POST['scenarioNumber']) ? $_POST['scenarioNumber'] : '' }}' {{old('scenarioNumber')}}><br/>
        <!--text input box for loan scenario name -->
        <label for='scenarioName'>Loan Scenario Name:*</label>
        <input type='text' id='scenarioName' name='scenarioName'
        title="User friendly name for Scenario, max characters 190"
        value= '{{ isset($_POST['scenarioName']) ? $_POST['scenarioName'] : '' }}' {{old('scenarioName')}}><br/>
        <!--text input box for loan amount entry -->
        <label for='loan'>Loan Amount:*</label>
        <input type='number' id='loan' step='0.01' min='1' name='loan'
        title="Max loan amount=$100000000"
        value= '{{ isset($_POST['loan']) ? $_POST['loan'] : '' }}' {{old('loan')}}><br/>
        <!--Reference: Information leveraged to retain data in textboxes
         https://laracasts.com/discuss/channels/laravel/input-data-not-remaining-after-refresh-using-old?page=1-->
        <!--text input box for interest rate entry -->
        <label for='interestRate'>Interest Rate:*</label>
        <input type='number' id='interestRate' step='0.001' min='1.01' name='interestRate'
        title="In actual numbers, e.g. for 4.5% enter 4.5, Min=1, Max=25"
        value= '{{ isset($_POST['interestRate']) ? $_POST['interestRate'] : '' }}' {{old('interestRate')}}><br/>
        <!--option radio buttons for type of interest rate -->
        <b>Interest Type:*</b>
        <label><input type='radio' name='interestType' value='fixed' {{ isset($_POST['interestType']) && $_POST['interestType']=='fixed' ? 'checked' : '' }} {{old('interestType')=='fixed' ? 'checked' : ''}}> Fixed</label>
        <label><input type='radio' name='interestType' value='variable' {{ isset($_POST['interestType']) && $_POST['interestType']=='variable' ? 'checked' : '' }} {{old('interestType')=='variable'  ? 'checked' : ''}}> Variable</label><br/>
        <!--Reference: Information leveraged to retain option boxes checked
        https://laracasts.com/discuss/channels/laravel/sex-radio-input-options-old-input-->
        <!--select downdown for duration of loan in years -->
        <label for='loanDuration'>Select loan duration*</label>
        <select name='loanDuration' id='loanDuration'>
          <option value=''> Select one</option>
          <option value='15' {{ isset($_POST['loanDuration']) && $_POST['loanDuration']=='15' ? 'Selected' : '' }} {{old('loanDuration')=='15' ? 'Selected' : ''}} > 15 yrs</option>
          <option value='20' {{ isset($_POST['loanDuration']) && $_POST['loanDuration']=='20' ? 'Selected' : '' }} {{old('loanDuration')=='20' ? 'Selected' : ''}} > 20 yrs</option>
          <option value='25' {{ isset($_POST['loanDuration']) && $_POST['loanDuration']=='25' ? 'Selected' : '' }} {{old('loanDuration')=='25' ? 'Selected' : ''}} > 25 yrs</option>
          <option value='30' {{ isset($_POST['loanDuration']) && $_POST['loanDuration']=='30' ? 'Selected' : '' }} {{old('loanDuration')=='30' ? 'Selected' : ''}} > 30 yrs</option>
          <option value='35' {{ isset($_POST['loanDuration']) && $_POST['loanDuration']=='35' ? 'Selected' : '' }} {{old('loanDuration')=='35' ? 'Selected' : ''}} > 35 yrs</option>
          <option value='40' {{ isset($_POST['loanDuration']) && $_POST['loanDuration']=='40' ? 'Selected' : '' }} {{old('loanDuration')=='40' ? 'Selected' : ''}} > 40 yrs</option>
        </select><br/>

        <!--select downdown for property name populated by database, to attach property listing to the loan scenario using laravel model and database joins -->
        <!--leveraged example from class notes http://dwa15.com -->
        <label for='property'>Select a property*</label>
        <select name='property' id='property'>
          <option value='0'>Choose</option>
            @foreach($properties as $properties)
            <option value='{{$properties->id}}' {{ isset($_POST['property']) && $_POST['property']==$properties->id ? 'Selected' : '' }}>{{$properties->property_name}}</option>
            @endforeach
        </select><br/>
        <!--Reference: Techniques leveraged to populate select dropdown option from the database:
        https://laracasts.com/discuss/channels/laravel/fetch-dropdown-list-from-database-in-l-52?page=1 -->
        <!--Reference: Techniques leveraged to populate select dropdown option from the database:
        http://stackoverflow.com/questions/35421804/laravel-5-2-populate-select-options-from-database -->

        <!--submit & reset buttons -->
        <input type='submit' name='submit' class='btn btn-primary btn-small' value='save'>
        <input type='button' name='reset' class='btn btn-primary btn-small' onclick="parent.location='save'" value='Reset Form'>
        <!--Reference: Technique for reset button, got ideas from Piazza forum and this website:
        http://www.plus2net.com/html_tutorial/button-linking.php -->
  </form>

@endsection


@section('error_content')
    <!--check for validation errors, if found, display and hald calculations, code leveraged from class lecture notes -->
    <h6>&nbsp;</h6><br/>
    <p>* Required fields<br/>
       &#8224; Mouseover input box fields for data entry guidance.
    </p>
    @if(count($errors) > 0)
      <h4>Data entry error found. See below: </h4>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }} </li>
            @endforeach
            Input values preset to previously entered values.
            Please submit form again with preset values or with updated values.
        </ul>
    @endif
@endsection

@section('mortcalc_content')
    <!--conditional display once GET happens; display of inputs, calculated status, and mortgage payment -->
    <h6>&nbsp;</h6>
    @if($_POST && count($errors) == 0)
      <hr>
        <div>
          <h3>Mortgage Loan Scenario Saved</h3>
          Scenario Number: {{$scenarioNumber or ''}} <br/>
          Scenario Name: {{$scenarioName or ''}} <br/>
          Loan Amount: ${{$loanDisplay or ''}} <br/>
          Interest Rate (Annual): {{$interestRateDisplay or ''}}% <br/>
          Interest Rate (Monthly): {{$interestRateMonthlyDisplay or ''}}% <br/>
          Interest Type: {{$interestTypeDisplay or ''}} <br/>
          Loan Duration Years: {{$loanDurationDisplay or ''}} yrs <br/>
          Loan Duration Months: {{$loanMonths or ''}} mons <br/>
          Loan Monthly Payment: ${{$monthlyPaymentDisplay or ''}} <br/>
          Total Interest Paid: ${{$interestTotal}} <br/>
          Average Interest Rate (Monthly): {{$interestRateAvg}}% <br/>
          Total Loan Cost: ${{$loanTotalCost}} <br/>
          Number Payments : {{$loanMonths}} <br/>
          Property Id: {{$property}} <br/>
          Property Name: {{$propertyName}} <br/>

        </div>
    @endif
@endsection

@section('loancost_content')
  <!--blade template placeholder section, satisfies html validator requirements -->
    <h6>&nbsp;</h6>
@endsection

@section('amorttbl_content')
    <!--conditional display of mortgage amortization table, code stored on separate php files that has table display logic (soc)-->
    <h6>&nbsp;</h6>
    {{-- @if(!empty($_GET['show_table']) && $_GET && count($errors) == 0)
      <hr>
        <div>
          <h3>Mortgage Amortization Schedule</h3>
          @include('amortTbl');
        </div>
    @endif --}}
@endsection
