{{-- /resources/views/property/update.blade.php --}}
{{-- blade view to update a single real estate property; leveraged some code from class notes -- --}}

@extends('layouts.master')

@section('title')
  Real Estate Property Information
@endsection

@section('form_content')
  <h2>Update a new Real Estate Property Information in the Database</h2>
  <!--start of form -->
  <Form method='POST' action='/property/update' id='formPropUpdate'>
        <!--cross site attack defence-->
        {{ csrf_field() }}
        <!--hidden number input box for loading up the property information using id autogenerated by the database-->
        <input type='hidden' name='id' value='{{$properties->id}}'>
        <!--number input box for property mls number -->
        <label for='propertyNumber'>Property MLS Number:*</label>
        <input type='number' id='propertyNumber' name='propertyNumber'
        title='User friendly number for identification (MLS), max number=1000000'
        value= '{{$properties->property_number}}' ><br/>
        <!--input text box for property name to be maintained by the user for identifying visually-->
        <label for='propertyName'>Property Name:*</label>
        <input type='text' id='propertyName' name='propertyName'
        title="User friendly name for Property, max characters 190"
        value= '{{$properties->property_name}}' ><br/>
        <!--input text box for Property Address -->
        <label for='propertyAddress'>Property Address:*</label>
        <input type='text' id='propertyAddress' name='propertyAddress'
        title='Property number street name, city, state, and zip; max characters 190'
        value= '{{$properties->property_address}}' ><br/>
        <!--select downdown for property type -->
        <label for='propertyType'>Select a Property Type* </label>
        <select name='propertyType' id='propertyType'>
          <option value=''> Select one</option>
          <option value='Single Family Home' {{ isset($_POST['propertyType']) && $_POST['propertyType']=='Single Family Home' ? 'Selected' : '' }} {{$properties->property_type=='Single Family Home' ? 'Selected' : ''}} > Single Family Home</option>
          <option value='Townhouse' {{ isset($_POST['propertyType']) && $_POST['propertyType']=='Townhouse' ? 'Selected' : '' }} {{$properties->property_type=='Townhouse' ? 'Selected' : ''}} > Townhouse</option>
          <option value='Duplex' {{ isset($_POST['propertyType']) && $_POST['propertyType']=='Duplex' ? 'Selected' : '' }} {{$properties->property_type=='Duplex' ? 'Selected' : ''}} > Duplex</option>
          <option value='Appartment' {{ isset($_POST['propertyType']) && $_POST['propertyType']=='Appartment' ? 'Selected' : '' }} {{$properties->property_type=='Appartment' ? 'Selected' : ''}} > Appartment</option>
          <option value='Condo' {{ isset($_POST['propertyType']) && $_POST['propertyType']=='Condo' ? 'Selected' : '' }} {{$properties->property_type=='Condo' ? 'Selected' : ''}} > Condo</option>
        </select><br/>

        <!--Select Option boxes for Property Size -->
        <label for='propertySizeBd'>Property Size:* </label>
        <!--Select Option boxes for Beds -->
        Bd <select name='propertySizeBd' id='propertySizeBd' title='Beds'>
            <option value=''> choose one </option>
            @for($k=1; $k<10; $k++)
              <option value= '{{$k}}' {{ isset($_POST['propertySizeBd']) && $_POST['propertySizeBd']==$k ? 'Selected' : '' }} {{substr($properties->property_size,0,1)==$k ? 'Selected' : ''}} > {{$k}}</option>
            @endfor
           </select>
        <!--Select Option boxes for Baths -->
        Ba <select name='propertySizeBa' id='propertySizeBa' title='Baths'>
          <option value=''> choose one</option>
          @for($l=1; $l<10; $l++)
            <option value='{{$l}}' {{ isset($_POST['propertySizeBa']) && $_POST['propertySizeBa']==$l ? 'Selected' : '' }} {{substr($properties->property_size,4,1)==$l ? 'Selected' : ''}} > {{$l}}</option>
          @endfor
          </select>
        <!--Select Option boxes for Garages -->
        Ga  <select name='propertySizeGa' id='propertySizeGa' title='Garages'>
          <option value='0'> choose one</option>
          @for($m=0; $m<10; $m++)
            <option value='{{$m}}' {{ isset($_POST['propertySizeGa']) && $_POST['propertySizeGa']==$m ? 'Selected' : '' }} {{substr($properties->property_size,8,1)==$m ? 'Selected' : ''}} > {{$m}}</option>
          @endfor
          </select><br/>

        <!--input text box for Property Living Space -->
        <label for='livingArea'>Property Living Space (sqft):* </label>
        <input type='text' id='livingArea' name='livingArea'
        title='Living space, all numerical, max 10000'
        value= '{{$properties->living_area}}' ><br/>
        <!--input text box for Property Lot Size -->
        <label for='lotSize'>Property Lot Size (acres):* </label>
        <input type='text' id='lotSize' name='lotSize'
        title='Size of the lot, all numerical, max 10000'
        value= '{{$properties->lot_size}}' ><br/>
        <!--input text box for Property Year Built -->
        <label for='yearBuilt'>Property Year Built:* </label>
        <input type='text' id='yearBuilt' name='yearBuilt'
        title='Enter year in 4 digit numbers only, min 1000, max 2017'
        value= '{{$properties->year_built}}' ><br/>
        <!--input text box for Property Sale Price -->
        <label for='salePrice'>Property Sale Price ($):* </label>
        <input type='text' id='salePrice' name='salePrice'
        title='Sales price of the property, all numerical entries, max price 100000000'
        value= '{{$properties->sale_price}}' ><br/>
        <!--input text box for Property Tax Rate -->
        <label for='taxRate'>Property Tax Rate (%):* </label>
        <input type='text' id='taxRate' name='taxRate'
        title='In actual numbers, e.g. for 2.5% enter 2.5, Min=0, Max=10'
        value= '{{$properties->tax_rate}}' ><br/>
        <!--input text box for Property Yearly HOA -->
        <label for='hoaYearly'>Property Yearly HOA ($):* </label>
        <input type='text' id='hoaYearly' name='hoaYearly'
        title='All numerical entry, Min=0, Max=10000'
        value= '{{$properties->hoa_yearly}}' ><br/>
        <!--submit & reset buttons -->
        <input type='submit' name='submit' class='btn btn-primary btn-small' value='save'>

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
    <!--blade template placeholder section, satisfies html validator requirements -->
    <h6>&nbsp;</h6>
@endsection

@section('amorttbl_content')
    <!--blade template placeholder section, satisfies html validator requirements -->
    <h6>&nbsp;</h6>
@endsection
