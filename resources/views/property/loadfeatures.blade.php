{{-- /resources/views/index.blade.php --}}
@extends('layouts.master')

@section('title')
    Feature Lists for Real Estate Property
@endsection

@section('form_content')
  @if(Request::path()=='property/viewfeatures') {{-- http://easylaravel.com/check-current-url --}}
         <h2>View Features for a Real Estate Property from the Database</h2>
  @elseif(Request::path()=='property/increasefeatures')
         <h2>Add Features to a Real Estate Property saving to the Database</h2>
  @elseif(Request::path()=='property/decreasefeatures')
         <h2>Delete/Remove Features attached to a Real Estate Property from the Database</h2>
  @else
         <h2>Delete/Remove Features attached to a Real Estate Property from the Database</h2>
  @endif

  @if(count($properties) > 0)
      <h5>(Property MLS) Property Name</h5>
      <ul>
      @foreach ($properties as $properties)
          ({{$properties->property_number}})
          @if(Request::path()=='property/viewfeatures')
                <a href="{{ url('/property/viewfeatures',$properties->id) }}">{{$properties->property_name}}</a>.
          @elseif(Request::path()=='property/increasefeatures')
                <a href="{{ url('/property/addfeatures',$properties->id) }}">{{$properties->property_name}}</a>.
          @elseif(Request::path()=='property/decreasefeatures')
                <a href="{{ url('/property/removefeature',$properties->id) }}">{{$properties->property_name}}</a>.
          @endif
          </br>
          {{-- http://stackoverflow.com/questions/39639707/right-way-to-build-a-link-in-laravel-5-3 --}}
      @endforeach

      </ul>
  @endif

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
