{{-- /resources/views/index.blade.php --}}
@extends('layouts.master')

@section('title')
    Real Estate Property Information
@endsection

@section('form_content')
 <h2>Remove Real Estate Property Feature from Database</h2>

   <h3>Confirm deletion</h3>
       <form method='POST' action='/property/removefeature'>

           {{ csrf_field() }}

           <input type='hidden' name='id' value='{{ $properties->id }}'?>
           <label for='propertyNumber'>Property MLS Number:</label>
           <input type='number' id='propertyNumber' name='propertyNumber' value= '{{$properties->property_number}}' ><br/>
           <!--text input box for loan scenario name to be maintained by the user for identifying the scenario visually-->
           <label for='propertyName'>Property Name:</label>
           <input type='text' id='propertyName' name='propertyName' value= '{{$properties->property_name}}' ><br/>

           <label>Key Features</label>
           <ul id='features3'>
               @foreach($featureSelected as $featureSelected)
                   <li>{{ $featureSelected->id }},
                     {{ $featureSelected->feature_name }},
                    </li>
               @endforeach
           </ul>

           <select name='featureSelect' id='featureSelect'>
             <option value='0'>Choose</option>
               @foreach($features as $features)
               <option value='{{$features->id}}'> {{$features->feature_name}}</option>
               @endforeach
           </select></br>


           {{-- <h2>Are you sure you want to remove this property feature from the database <em>{{ $properties->property_name }}</em>?</h2> --}}

           <input type='submit' value='Confirm Remove' class='btn btn-danger'>

       </form>


@endsection


@section('error_content')
    <!--check for validation errors, if found, display and hald calculations, code leveraged from class lecture notes -->
    <h6>&nbsp;</h6>
@endsection

@section('mortcalc_content')
    <!--conditional display once GET happens; display of inputs, calculated status, and mortgage payment -->
    <h6>&nbsp;</h6>
@endsection

@section('loancost_content')
    <!--conditional display once GET happens check box is checked; display of loan lifetime cost summary -->
    <h6>&nbsp;</h6>
@endsection

@section('amorttbl_content')
    <!--conditional display of mortgage amortization table, code stored on separate php files that has table display logic (soc)-->
    <h6>&nbsp;</h6>
@endsection
