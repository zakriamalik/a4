{{-- /resources/views/scenario/update.blade.php --}}
@extends('layouts.master')

@section('title')
    Real Estate Property Information
@endsection

@section('form_content')
  <h2>View a Real Estate Property Information saved in the Database</h2>
    <!--start of form using POST method -->
    <Form method='GET' action='/property/view' id='formView'>
        <h3> Real Estate Property Information </h3>
        <!--hidden number input box for loading up the loan scenario using dbrow_id autogenerated by the database-->
        <input type='hidden' name='prop_id' value='{{$properties->property_number}}' disabled>
        <!--number input box for loan scenario number maintained by the user-->
        <label for='propertyNumber'>Property MLS Number:</label>
        <input type='number' id='propertyNumber' step='1' min='1' name='propertyNumber' value= '{{$properties->property_number}}' disabled><br/>
        <!--text input box for loan scenario name to be maintained by the user for identifying the scenario visually-->
        <label for='propertyName'>Loan Scenario Name:</label>
        <input type='text' id='propertyName' name='propertyName' value= '{{$properties->property_name}}' disabled><br/>
        <!--text read only box for Property Address -->
        <label for='propertyAddress'>Property Address:</label>
        <input type='text' id='propertyAddress' name='propertyAddress' value= '{{$properties->property_address}}' size='50' disabled><br/>
        <!--text read only box for Property Type -->
        <label for='propertyType'>Property Type: </label>
        <input type='text' id='propertyType' name='propertyType' value= '{{$properties->property_type}}' disabled><br/>
        <!--text read only box for Property Size -->
        <label for='propertySize'>Property Size: </label>
        <input type='text' id='propertySize' name='propertySize' value= '{{$properties->property_size}}' disabled><br/>
        <!--text read only box for Property Living Space -->
        <label for='livingArea'>Property Living Space (sqft): </label>
        <input type='text' id='livingArea' name='livingArea' value= '{{$properties->living_area}}' disabled><br/>
        <!--text read only box for Property Lot Size -->
        <label for='lotSize'>Property Lot Size (acres): </label>
        <input type='text' id='lotSize' name='lotSize' value= '{{$properties->lot_size}}' disabled><br/>
        <!--text read only box for Property Year Built -->
        <label for='yearBuilt'>Property Year Built: </label>
        <input type='text' id='yearBuilt' name='yearBuilt' value= '{{$properties->year_built}}' disabled><br/>
        <!--text read only box for Property Sale Price -->
        <label for='salePrice'>Property Sale Price ($): </label>
        <input type='text' id='salePrice' name='salePrice' value= '{{$properties->sale_price}}' disabled><br/>
        <!--text read only box for Property Tax Rate -->
        <label for='taxRate'>Property Tax Rate (%): </label>
        <input type='text' id='taxRate' name='taxRate' value= '{{$properties->tax_rate}}' disabled><br/>
        <!--text read only box for Property Yearly HOA -->
        <label for='hoaYearly'>Property Yearly HOA ($): </label>
        <input type='text' id='hoaYearly' name='hoaYearly' value= '{{$properties->hoa_yearly}}' disabled><br/>


        <label>Key Features</label> {{-- Leveraged class lecture notes: https://github.com/susanBuck/foobooks/blob/master/resources/views/books/edit.blade.php --}}
        <ul id='features'>
            @foreach($features as $feature)
                <li>{{ $feature->feature_name }}</li>
            @endforeach
        </ul>

        <!--submit & reset buttons -->
        {{-- <input type='submit' name='submit' class='btn btn-primary btn-small' value='save'> --}}
        {{-- <input type='button' name='reset' class='btn btn-primary btn-small' onclick="location='./{{$id}}'" value='Reset Form'> --}}
        <!--Reference: Technique for reset button, got ideas from Piazza forum and this website:
        http://www.plus2net.com/html_tutorial/button-linking.php -->
  </form>

@endsection


@section('error_content')
    <!--check for validation errors, if found, display and hald calculations, code leveraged from class lecture notes -->
    <h6>&nbsp;</h6>
    {{-- @if(count($errors) > 0)
      <h4>Data entry error found. See below: </h4>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }} </li>
            @endforeach
            Input values preset to previously saved values.
        </ul>
    @endif --}}
@endsection

@section('mortcalc_content')
    <!--conditional display once GET happens; display of inputs, calculated status, and mortgage payment -->
    <h6>&nbsp;</h6>
    {{-- @if($_POST && count($errors) == 0)
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

        </div>
    @endif --}}
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
