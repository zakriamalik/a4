{{-- /resources/views/property/save.blade.php --}}
{{-- blade view to save a single real estate property --}}

@extends('layouts.master')

@section('title')
  Real Estate Property Information
@endsection

@section('form_content')
  <h2>Save a new Real Estate Property Information in the Database</h2>
  <!--start of form -->
  <Form method='POST' action='/property/save' id='formPropSave'>
        <!--cross site attack defence-->
        {{ csrf_field() }}
        <!--number input box for loan property mls number -->
        <label for='propertyNumber'>Property MLS Number:</label>
        <input type='number' id='propertyNumber' name='propertyNumber' value= {{ isset($_POST['propertyNumber']) ? $_POST['propertyNumber'] : '' }} {{old('propertyNumber')}}><br/>
        <!--input text box for property name to be maintained by the user for identifying easily-->
        <label for='propertyName'>Property Name:</label>
        <input type='text' id='propertyName' name='propertyName' value= {{ isset($_POST['propertyName']) ? $_POST['propertyName'] : '' }} {{old('propertyName')}}><br/>
        <!--input text box for Property Address -->
        <label for='propertyAddress'>Property Address:</label>
        <input type='text' id='propertyAddress' name='propertyAddress' value= {{ isset($_POST['propertyAddress']) ? $_POST['propertyAddress'] : '' }} {{old('propertyAddress')}}><br/>
        {{-- <!--input text box for Property Type -->
        <label for='propertyType'>Property Type: </label>
        <input type='text' id='propertyType' name='propertyType' value= {{ isset($_POST['propertyType']) ? $_POST['propertyType'] : '' }} {{old('propertyType')}}><br/> --}}
        <!--select downdown for property type -->
        <label for='propertyType'>Select a Property Type</label>
        <select name='propertyType' id='propertyType'>
          <option value=''> Select one</option>
          <option value='Single Family Home' {{ isset($_POST['propertyType']) && $_POST['propertyType']=='Single Family Home' ? 'Selected' : '' }} {{old('propertyType')=='Single Family Home' ? 'Selected' : ''}} > Single Family Home</option>
          <option value='Townhouse' {{ isset($_POST['propertyType']) && $_POST['propertyType']=='Townhouse' ? 'Selected' : '' }} {{old('propertyType')=='Townhouse' ? 'Selected' : ''}} > Townhouse</option>
          <option value='Duplex' {{ isset($_POST['propertyType']) && $_POST['propertyType']=='Duplex' ? 'Selected' : '' }} {{old('propertyType')=='Duplex' ? 'Selected' : ''}} > Duplex</option>
          <option value='Appartment' {{ isset($_POST['propertyType']) && $_POST['propertyType']=='Appartment' ? 'Selected' : '' }} {{old('propertyType')=='Appartment' ? 'Selected' : ''}} > Appartment</option>
          <option value='Condo' {{ isset($_POST['propertyType']) && $_POST['propertyType']=='Condo' ? 'Selected' : '' }} {{old('propertyType')=='Condo' ? 'Selected' : ''}} > Condo</option>
        </select><br/>
        <!--input text boxes for Property Size -->
        <label for='propertySize'>Property Size: </label>
        Bd<input type='number' id='propertySizeBd' name='propertySizeBd' step='1' min='1' max='9' Size='5' pattern='[0-9]' value= {{ isset($_POST['propertySizeBd']) ? $_POST['propertySizeBd'] : '' }} {{old('propertySizeBd')}}>
        Ba<input type='number' id='propertySizeBa' name='propertySizeBa' step='1' min='1' max='9' Size='5' pattern='[0-9]' value= {{ isset($_POST['propertySizeBa']) ? $_POST['propertySizeBa'] : '' }} {{old('propertySizeBa')}}>
        Ga<input type='number' id='propertySize' name='propertySizeGa' step='1' min='0' max='9' Size='5' pattern='[0-9]' value= {{ isset($_POST['propertySizeGa']) ? $_POST['propertySizeGa'] : '' }} {{old('propertySizeGa')}}><br/>
        <!--input text box for Property Living Space -->
        <label for='livingArea'>Property Living Space (sqft): </label>
        <input type='text' id='livingArea' name='livingArea' value= {{ isset($_POST['livingArea']) ? $_POST['livingArea'] : '' }} {{old('livingArea')}}><br/>
        <!--input text box for Property Lot Size -->
        <label for='lotSize'>Property Lot Size (acres): </label>
        <input type='text' id='lotSize' name='lotSize' value= {{ isset($_POST['lotSize']) ? $_POST['lotSize'] : '' }} {{old('lotSize')}}><br/>
        <!--input text box for Property Year Built -->
        <label for='yearBuilt'>Property Year Built: </label>
        <input type='text' id='yearBuilt' name='yearBuilt' value= {{ isset($_POST['yearBuilt']) ? $_POST['yearBuilt'] : '' }} {{old('yearBuilt')}}><br/>
        <!--input text box for Property Sale Price -->
        <label for='salePrice'>Property Sale Price ($): </label>
        <input type='text' id='salePrice' name='salePrice' value= {{ isset($_POST['salePrice']) ? $_POST['salePrice'] : '' }} {{old('salePrice')}}><br/>
        <!--input text box for Property Tax Rate -->
        <label for='taxRate'>Property Tax Rate (%): </label>
        <input type='text' id='taxRate' name='taxRate' value= {{ isset($_POST['taxRate']) ? $_POST['taxRate'] : '' }} {{old('taxRate')}}><br/>
        <!--input text box for Property Yearly HOA -->
        <label for='hoaYearly'>Property Yearly HOA ($): </label>
        <input type='text' id='hoaYearly' name='hoaYearly' value= {{ isset($_POST['hoaYearly']) ? $_POST['hoaYearly'] : '' }} {{old('hoaYearly')}}><br/>

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
    <!--conditional display once GET happens; display of inputs, calculated status, and property info -->
    <h6>&nbsp;</h6>
    @if($_POST && count($errors) == 0)
      <hr>
        <div>
          <h3>Real Estate Property Information Saved</h3>
          Property Number: {{$properties->property_number or ''}} <br/>
          Property Name: {{$properties->property_name or ''}} <br/>
          Property Address: {{$properties->property_address or ''}} <br/>
          Property Type: {{$properties->property_type or ''}} <br/>
          Property Size: {{$properties->property_size or ''}} <br/>
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
    <!--blade template placeholder section, satisfies html validator requirements -->
    <h6>&nbsp;</h6>
@endsection

@section('amorttbl_content')
    <!--blade template placeholder section, satisfies html validator requirements -->
    <h6>&nbsp;</h6>
@endsection
