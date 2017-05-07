{{-- /resources/views/index.blade.php --}}
@extends('layouts.master')

@section('title')
    Mortgage Payment Calculator
@endsection

@section('form_content')
  <h2>Save Mortgage Payment to Database</h2>
  <!--start of form -->
  <Form method='POST' action='/scenario/save' id='formMort'>
        {{ csrf_field() }}
        <!--text input box for loan scenario number -->
        <label for='scenarioNumber'>Loan Scenario Number:</label>
        <input type='number' id='scenarioNumber' step='1' min='1' name='scenarioNumber' value= {{ isset($_POST['scenarioNumber']) ? $_POST['scenarioNumber'] : '' }} {{old('scenarioNumber')}}><br/>
        <!--text input box for loan scenario name -->
        <label for='scenarioName'>Loan Scenario Name:</label>
        <input type='text' id='scenarioName' name='scenarioName' value= {{ isset($_POST['scenarioName']) ? $_POST['scenarioName'] : '' }} {{old('scenarioName')}}><br/>

        <!--text input box for loan amount entry -->
        <label for='loan'>Loan Amount:</label>
        <input type='number' id='loan' step='0.01' min='1' name='loan' value= {{ isset($_POST['loan']) ? $_POST['loan'] : '' }} {{old('loan')}}><br/>
        <!--Reference: Information leveraged to retain data in textboxes
         https://laracasts.com/discuss/channels/laravel/input-data-not-remaining-after-refresh-using-old?page=1-->

        <!--text input box for interest rate entry -->
        <label for='interestRate'>Interest Rate:</label>
        <input type='number' id='interestRate' step='0.001' min='1.01' name='interestRate' value= {{ isset($_POST['interestRate']) ? $_POST['interestRate'] : '' }} {{old('interestRate')}}><br/>

        <!--option radio buttons for type of interest rate -->
        <b>Interest Type:</b>
        <label><input type='radio' name='interestType' value='fixed' {{ isset($_POST['interestType']) && $_POST['interestType']=='fixed' ? 'checked' : '' }} {{old('interestType')=='fixed' ? 'checked' : ''}}> Fixed</label>
        <label><input type='radio' name='interestType' value='variable' {{ isset($_POST['interestType']) && $_POST['interestType']=='variable' ? 'checked' : '' }} {{old('interestType')=='variable'  ? 'checked' : ''}}> Variable</label><br/>
        <!--Reference: Information leveraged to retain option boxes checked
        https://laracasts.com/discuss/channels/laravel/sex-radio-input-options-old-input-->

        <!--select downdown for duration of loan in years -->
        <label for='loanDuration'>Select loan duration</label>
        <select name='loanDuration' id='loanDuration'>
          <option value=''> Select one</option>
          <option value='15' {{ isset($_POST['loanDuration']) && $_POST['loanDuration']=='15' ? 'Selected' : '' }} {{old('loanDuration')=='15' ? 'Selected' : ''}} > 15 yrs</option>
          <option value='20' {{ isset($_POST['loanDuration']) && $_POST['loanDuration']=='20' ? 'Selected' : '' }} {{old('loanDuration')=='20' ? 'Selected' : ''}} > 20 yrs</option>
          <option value='25' {{ isset($_POST['loanDuration']) && $_POST['loanDuration']=='25' ? 'Selected' : '' }} {{old('loanDuration')=='25' ? 'Selected' : ''}} > 25 yrs</option>
          <option value='30' {{ isset($_POST['loanDuration']) && $_POST['loanDuration']=='30' ? 'Selected' : '' }} {{old('loanDuration')=='30' ? 'Selected' : ''}} > 30 yrs</option>
          <option value='35' {{ isset($_POST['loanDuration']) && $_POST['loanDuration']=='35' ? 'Selected' : '' }} {{old('loanDuration')=='35' ? 'Selected' : ''}} > 35 yrs</option>
          <option value='40' {{ isset($_POST['loanDuration']) && $_POST['loanDuration']=='40' ? 'Selected' : '' }} {{old('loanDuration')=='40' ? 'Selected' : ''}} > 40 yrs</option>
        </select><br/>

        <select name='propertySelect' id='propertySelect'>
          <option value='0'>Choose</option>
            @foreach($properties as $properties)
            <option value='{{$properties->prop_id}}' {{ isset($_POST['propertySelect']) && $_POST['propertySelect']==$properties->prop_id ? 'Selected' : '' }}>{{$properties->property_name}}</option>
            @endforeach
        </select></br>

        {{-- <select name='property_id' id='property_id'>
            <option value='0'>Choose</option>
            @foreach($propertiesForDropdown as $property_id => $propertyName)
                <option value='{{ $property_id }}'>
                    {{ $propertyName }}
                </option>
            @endforeach
        </select> --}}

        <!--submit & reset buttons -->
        <input type='submit' name='submit' class='btn btn-primary btn-small' value='save'>
        <input type='button' name='reset' class='btn btn-primary btn-small' onclick="parent.location='save'" value='Reset Form'>
        <!--Reference: Technique for reset button, got ideas from Piazza forum and this website:
        http://www.plus2net.com/html_tutorial/button-linking.php -->
  </form>

@endsection


@section('error_content')
    <!--check for validation errors, if found, display and hald calculations, code leveraged from class lecture notes -->
    <h6>&nbsp;</h6>
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
          Property Id: {{$propertySelect}} <br/>

        </div>
    @endif
@endsection

@section('loancost_content')
    <!--conditional display once GET happens check box is checked; display of loan lifetime cost summary -->
    <h6>&nbsp;</h6>
    {{-- @if(!empty($_GET['show_loanCost']) && $_GET && count($errors) == 0)
      <hr>
        <div>
          <h3>Mortgage Lifetime Cost Summary</h3>
          Loan Amount: ${{$loanDisplay}}<br/>
          Total Interest Paid: ${{$interestTotal}}<br/>
          Average Interest Rate (Monthly): {{$interestRateAvg}}%<br/>
          Total Loan Cost: ${{$loanTotalCost}}<br/>
          Number Payments : {{$loanMonths}}<br/>
          From: {{$array_date[1]}} to {{$array_date[$loanMonths]}}
        </div>
        <input type='button' name='save' class='btn btn-primary btn-small' onclick="parent.location='/scenario/save'" value='Save Scenario'>
    @endif --}}
    <p><a href="/scenario">Mortgage Scenario Landing Page</a></p>
    <p><a href="/index.php">Mortgage Payment Calculator</a></p>
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
