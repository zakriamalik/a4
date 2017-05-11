{{-- /resources/views/property/loadfeatures.blade.php --}}
{{-- blade view to list properties for which actions on features can be performed --}}

@extends('layouts.master')

@section('title')
    Feature Lists for Real Estate Property
@endsection

@section('form_content')
  {{-- heading for conditional routing based on the url which bring to the loading page --}}
  @if(Request::path()=='property/viewfeatures')
         <h2>View Features for a Real Estate Property from the Database</h2>
  @elseif(Request::path()=='property/increasefeatures')
         <h2>Add Features to a Real Estate Property saving to the Database</h2>
  @elseif(Request::path()=='property/decreasefeatures')
         <h2>Delete/Remove Features attached to a Real Estate Property from the Database</h2>
  @else
         <h2>View Features for a Real Estate Property from the Database</h2>
  @endif
  {{--Reference: Technique leveraged for check current url for conditional routing.
  http://easylaravel.com/check-current-url --}}

  {{-- loop for conditional routing based on the url which bring to the loading page --}}
  @if(count($properties) > 0)
      <h5>(Property MLS) Property Name</h5>
      <ul>
      @foreach ($properties as $properties)
          ({{$properties->property_number}})
          @if(Request::path()=='property/viewfeatures')
                <a href="{{ url('/property/viewfeatures',$properties->id) }}">{{$properties->property_name}}</a>
          @elseif(Request::path()=='property/increasefeatures')
                <a href="{{ url('/property/addfeatures',$properties->id) }}">{{$properties->property_name}}</a>
          @elseif(Request::path()=='property/decreasefeatures')
                <a href="{{ url('/property/removefeature',$properties->id) }}">{{$properties->property_name}}</a>
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
