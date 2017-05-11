{{-- /resources/views/property/load.blade.php --}}
{{-- blade view to list properties for which CRUD actions to be performed --}}

@extends('layouts.master')

@section('title')
    Real Estate Property Information
@endsection

@section('form_content')
  {{-- heading for conditional routing based on the url which bring to the loading page --}}
  @if(Request::path()=='property/view')
         <h2>View a Real Estate Property Information from the Database</h2>
  @elseif(Request::path()=='property/change')
         <h2>Update/Change Real Estate Property Information to the Database</h2>
  @elseif(Request::path()=='property/delete')
         <h2>Delete/Remove Real Estate Property Information from the Database</h2>
  @endif
  {{--Reference: Technique leveraged for check current url for conditional routing.
  http://easylaravel.com/check-current-url --}}

  {{-- loop for conditional routing based on the url which bring to the loading page --}}
  @if(count($properties) > 0)
      <h5>(Property ID) Property Name</h5>
      <ul>
      @foreach ($properties as $properties)
          ({{$properties->property_number}})
          @if(Request::path()=='property/view')
                <a href="{{ url('/property/view',$properties->id) }}">{{$properties->property_name}}</a>
          @elseif(Request::path()=='property/change')
                <a href="{{ url('/property/update',$properties->id) }}">{{$properties->property_name}}</a>
          @elseif(Request::path()=='property/delete')
                <a href="{{ url('/property/remove',$properties->id) }}">{{$properties->property_name}}</a>
          @endif
          </br>
          {{--Reference: Technique leveraged for build a url for conditional routing.
          http://stackoverflow.com/questions/39639707/right-way-to-build-a-link-in-laravel-5-3 --}}
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
