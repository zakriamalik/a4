{{-- /resources/views/property/removefeature.blade.php --}}
{{-- blade view remove feature from property, code leveraged from class notes  --}}

@extends('layouts.master')

@section('title')
    Real Estate Property Features
@endsection

@section('form_content')
 <h2>Remove a Real Estate Property Feature from Database</h2>

   <h3>Process Feature Removal</h3>
       <!--start of form -->
       <form method='POST' action='/property/removefeature'>
           {{-- <!--cross site attack defence--> --}}
           {{ csrf_field() }}
           <!--hidden input box for property name to be maintained -->
           <input type='hidden' name='id' value='{{ $properties->id }}'>
           <!--number input box for property number to be maintained by the user-->
           <label for='propertyNumber'>Property MLS Number:</label>
           <input type='number' id='propertyNumber' name='propertyNumber' value= '{{$properties->property_number}}' disabled><br/>
           <!--text input box for property name to be maintained by the user for identifying it easily-->
           <label for='propertyName'>Property Name:</label>
           <input type='text' id='propertyName' name='propertyName' value= '{{$properties->property_name}}' disabled><br/>

           <!--list of features tied to the property-->
           <label>Existing Key Features</label>
           <ul id='features'>
               @forelse($featureSelected as $featureSelect)
                   <li>{{ $featureSelect->feature_name }}</li>
               @empty
                   {{'No features found for this property for removal'}}
               @endforelse
           </ul>

           <!--select from the list of features to be removed from the property-->
           <label for 'featureSelect'>Select a Feature to Remove</label></br>
           <select name='featureSelect' id='featureSelect'>
             <option value='0'>Choose</option>
               @foreach($featureAmend as $featureAmend)
               <option value='{{$featureAmend->id}}'> {{$featureAmend->feature_name}}</option>
               @endforeach
           </select></br>

           <!--submit red button to confirm removal of feature-->
           @if(count($featureAmend)>0)
           <input type='submit' value='Confirm Remove' class='btn btn-danger'>
           @else
           <input type='submit' value='Confirm Remove' class='btn btn-danger' disabled>
           @endif
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
      </ul>
  @endif

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
