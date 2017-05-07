{{-- /resources/views/index.blade.php --}}
@extends('layouts.master')

@section('title')
    Real Estate Property Information
@endsection

@section('form_content')
  @if(Request::path()=='property/view') {{-- http://easylaravel.com/check-current-url --}}
         <h2>View a Real Estate Property Information from the Database</h2>
  @elseif(Request::path()=='property/change')
         <h2>Update/Change Real Estate Property Information to the Database</h2>
  @elseif(Request::path()=='property/delete')
         <h2>Delete/Remove Real Estate Property Information from the Database</h2>
  @endif

  @if(count($properties) > 0)
      <h5>(Property ID) Property Name</h5>
      <ul>
      @foreach ($properties as $properties)
          ({{$properties->property_number}})
          @if(Request::path()=='property/view')
                <a href="{{ url('/property/view',$properties->prop_id) }}">{{$properties->property_name}}</a>.
          @elseif(Request::path()=='property/change')
                <a href="{{ url('/property/update',$properties->prop_id) }}">{{$properties->property_name}}</a>.
          @elseif(Request::path()=='property/delete')
                <a href="{{ url('/property/remove',$properties->prop_id) }}">{{$properties->property_name}}</a>.
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
    <p><a href="/property">Real Estate Property Landing Page</a></p>
@endsection

@section('amorttbl_content')
    <!--conditional display of mortgage amortization table, code stored on separate php files that has table display logic (soc)-->
    <h6>&nbsp;</h6>
@endsection
