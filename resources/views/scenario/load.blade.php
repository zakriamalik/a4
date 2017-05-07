{{-- /resources/views/index.blade.php --}}
@extends('layouts.master')

@section('title')
    Mortgage Payment Calculator
@endsection

@section('form_content')
  @if(Request::path()=='scenario/view') {{-- http://easylaravel.com/check-current-url --}}
         <h2>View a Mortgage Scenario Information from the Database</h2>
  @elseif(Request::path()=='scenario/change')
         <h2>Update/Change Mortgage Scenario Information to the Database</h2>
  @elseif(Request::path()=='scenario/delete')
         <h2>Delete/Remove Mortgage Scenario Information from the Database</h2>
  @endif

  <!--start of form -->

  {{-- <select name='scenarioSelect' id='scenarioSelect'>
      @foreach($scenario as $scenario)
      <option value="{{$scenario->id}}" selected="selected">{{$scenario->id}}</option>
      @endforeach
  </select> --}}

  @if(count($scenario) > 0)
      <h5>(Scenario Number) Scenario Name</h5>
      <ul>
      @foreach ($scenario as $scenario)
          ({{$scenario->scenario_number}})
          @if(Request::path()=='scenario/view')
                <a href="{{ url('/scenario/view',$scenario->id) }}">{{$scenario->scenario_name}}</a>.
          @elseif(Request::path()=='scenario/change')
                <a href="{{ url('/scenario/update',$scenario->id) }}">{{$scenario->scenario_name}}</a>.
          @elseif(Request::path()=='scenario/delete')
                <a href="{{ url('/scenario/remove',$scenario->id) }}">{{$scenario->scenario_name}}</a>.
          @endif
          </br>
          {{-- http://stackoverflow.com/questions/39639707/right-way-to-build-a-link-in-laravel-5-3 --}}
      @endforeach

      </ul>
  @endif


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
    <p><a href="/scenario">Mortgage Scenario Landing Page</a></p>
    <p><a href="/index.php">Mortgage Payment Calculator</a></p>
@endsection

@section('amorttbl_content')
    <!--conditional display of mortgage amortization table, code stored on separate php files that has table display logic (soc)-->
    <h6>&nbsp;</h6>
@endsection
