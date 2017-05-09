{{-- /resources/views/load.blade.php --}}
{{-- intermediate loading page that loads up scenarios for user to pick and select for read, update, and delete --}}

@extends('layouts.master')

@section('title')
    List of Mortgage Loan Scenario for selection
@endsection

{{-- conditional routing based on current url; different heading is shown for different urls --}}
@section('form_content')
  @if(Request::path()=='scenario/view')
         <h2>View a Mortgage Scenario Information from the Database</h2>
  @elseif(Request::path()=='scenario/change')
         <h2>Update/Change Mortgage Scenario Information to the Database</h2>
  @elseif(Request::path()=='scenario/delete')
         <h2>Delete/Remove Mortgage Scenario Information from the Database</h2>
  @endif
  {{-- Reference: Technique leveraged to identify current url. http://easylaravel.com/check-current-url --}}

{{-- conditional routing based on current url; different urls are loaded for current url --}}
  @if(count($scenario) > 0)
      <h5>(#) Scenario Name...{{Request::path()}}</h5>
      <ul>
      @foreach ($scenario as $scenario)
          ({{$scenario->scenario_number}})
          @if(Request::path()=='scenario/view')
                <a href="{{ url('/scenario/view',$scenario->id) }}">{{$scenario->scenario_name}}</a>
          @elseif(Request::path()=='scenario/change')
                <a href="{{ url('/scenario/update',$scenario->id) }}">{{$scenario->scenario_name}}</a>
          @elseif(Request::path()=='scenario/delete')
                <a href="{{ url('/scenario/remove',$scenario->id) }}">{{$scenario->scenario_name}}</a>
          @endif
          </br>
{{-- Reference: Technique leveraged to build a dynamic url. http://stackoverflow.com/questions/39639707/right-way-to-build-a-link-in-laravel-5-3 --}}
      @endforeach
      </ul>
  @endif

@endsection


@section('error_content')
  <!--blade template placeholder section, satisfies html validator requirements -->
    <h6>&nbsp;</h6>
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
