{{-- /resources/views/index.blade.php --}}
@extends('layouts.master')

@section('title')
  Real Estate Property Information
@endsection

@section('form_content')
  <h2>Save a new Real Estate Property Information in the Database</h2>
  <!--start of form -->
  <Form method='POST' action='/property/save' id='formPropUpdate'>
        {{ csrf_field() }}
        <!--hidden number input box for loading up the loan scenario using dbrow_id autogenerated by the database-->
        <input type='hidden' name='prop_id' value='{{$properties->prop_id}}'>
        <!--text input box for loan scenario number -->
        <label for='propertyNumber'>Property MLS Number:</label>
        <input type='number' id='propertyNumber' name='propertyNumber' value= '{{$properties->property_number}}' ><br/>
        <!--text input box for loan scenario name to be maintained by the user for identifying the scenario visually-->
        <label for='propertyName'>Property Name:</label>
        <input type='text' id='propertyName' name='propertyName' value= '{{$properties->property_name}}' ><br/>
        <!--text read only box for Property Address -->
        <label for='propertyAddress'>Property Address:</label>
        <input type='text' id='propertyAddress' name='propertyAddress' value= '{{$properties->property_address}}' ><br/>
        <!--text read only box for Property Type -->
        <label for='propertyType'>Property Type: </label>
        <input type='text' id='propertyType' name='propertyType' value= '{{$properties->property_type}}' ><br/>
        <!--text read only box for Property Size -->
        <label for='propertySize'>Property Size: </label>
        <input type='text' id='propertySize' name='propertySize' value= '{{$properties->property_size}}' ><br/>
        <!--text read only box for Property Living Space -->
        <label for='livingArea'>Property Living Space (sqft): </label>
        <input type='text' id='livingArea' name='livingArea' value= '{{$properties->living_area}}' ><br/>
        <!--text read only box for Property Lot Size -->
        <label for='lotSize'>Property Lot Size (acres): </label>
        <input type='text' id='lotSize' name='lotSize' value= '{{$properties->lot_size}}' ><br/>
        <!--text read only box for Property Year Built -->
        <label for='yearBuilt'>Property Year Built: </label>
        <input type='text' id='yearBuilt' name='yearBuilt' value= '{{$properties->year_built}}' ><br/>
        <!--text read only box for Property Sale Price -->
        <label for='salePrice'>Property Sale Price ($): </label>
        <input type='text' id='salePrice' name='salePrice' value= '{{$properties->sale_price}}' ><br/>
        <!--text read only box for Property Tax Rate -->
        <label for='taxRate'>Property Tax Rate (%): </label>
        <input type='text' id='taxRate' name='taxRate' value= '{{$properties->tax_rate}}' ><br/>
        <!--text read only box for Property Yearly HOA -->
        <label for='hoaYearly'>Property Yearly HOA ($): </label>
        <input type='text' id='hoaYearly' name='hoaYearly' value= '{{$properties->hoa_yearly}}' ><br/>

        <!--submit & reset buttons -->
        <input type='submit' name='submit' class='btn btn-primary btn-small' value='save'>
        <input type='button' name='reset' class='btn btn-primary btn-small' onclick="location='./{{$prop_id}}'" value='Reset Form'>
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
          <h3>Real Estate Property Information Saved</h3>
          Property Number: {{$properties->property_number or ''}} <br/>
          Property Name: {{$properties->property_name or ''}} <br/>
          Property Address: {{$properties->property_address or ''}} <br/>
          Property Type: {{$properties->property_type or ''}} <br/>
          Property Size: {{$properties->property_size or ''}}% <br/>
          Property Living Space (sqft): {{$properties->living_area or ''}} <br/>
          Property Lot Size (acres): {{$properties->lot_size or ''}} yrs <br/>
          Year Built: {{$properties->year_built or ''}} mons <br/>
          Property Sale Price: ${{$properties->sale_price or ''}} <br/>
          Property Tax Rate: {{$properties->tax_rate}}% <br/>
          Property Yearly HOA: ${{$properties->hoa_yearly}} <br/>

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
    <p><a href="/property">Real Estate Property Management Landing Page</a></p>
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
