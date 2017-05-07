{{-- /resources/views/index.blade.php --}}
@extends('layouts.master')

@section('title')
    Mortgage Payment Calculator
@endsection

@section('form_content')
 <h2>Mortgage Scenario Information</h2>

    <ul>
      <a href="{{ url('/scenario','/update') }}">Update</a>.

    </ul>
  <!--start of form -->

  {{-- <select name='scenarioSelect' id='scenarioSelect'>
      @foreach($scenario as $scenario)
      <option value="{{$scenario->id}}" selected="selected">{{$scenario->id}}</option>
      @endforeach
  </select> --}}


  {{-- @foreach($scenario as $scenario)
  <option value="{{$scenario->id}}" selected="selected">{{$scenario->id}}</option>
  @endforeach --}}

<!-- https://laracasts.com/discuss/channels/laravel/fetch-dropdown-list-from-database-in-l-52?page=1 -->
<!-- http://stackoverflow.com/questions/35421804/laravel-5-2-populate-select-options-from-database -->
  {{-- <input type='submit' name='load' class='btn btn-primary btn-small' value='Load Form' onclick="parent.location='update/{{$scenario->id}}'"> --}}
 {{-- onclick="parent.location='load'" --}}

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
