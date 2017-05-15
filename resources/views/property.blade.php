{{-- /resources/views/property.blade.php --}}
@extends('layouts.master')

@section('title')
    Real Estate Property List Management
@endsection

@section('form_content')
 <h2>Real Estate Property List Management</h2>
    <!--List of real estate property listings displayed for user to click select for respective CRUD database actions -->
    <ul>
      <li><a href="{{ url('/property','viewAll') }}">ViewAll Saved Properties Listings</a></li>
      <li><a href="{{ url('/property','view') }}">View a single Property Listing</a></li>
      <li><a href="{{ url('/property','save') }}">Save a New Property Listing</a></li>
      <li><a href="{{ url('/property','change') }}">Update an Existing Property Listing</a></li>
      <li><a href="{{ url('/property','delete') }}">Remove an Existing Property Listing</a></li>
      <li><a href="{{ url('/property','viewfeatures') }}">View Features of an Existing Property Listing</a></li>
      <li><a href="{{ url('/property','increasefeatures') }}">Add Features to an Existing Property Listing</a></li>
      <li><a href="{{ url('/property','decreasefeatures') }}">Remove Features from Existing Property Listing</a></li>

    </ul>
@endsection


@section('error_content')
    <!--blade template placeholder section, satisfies html validator requirements -->
    <h6>&nbsp;</h6>
@endsection

@section('mortcalc_content')
    <!--blade template placeholder section, satisfies html validator requirements  -->
    <h6>&nbsp;</h6>
@endsection

@section('loancost_content')
    <!--blade template placeholder section, satisfies html validator requirements  -->
    <h6>&nbsp;</h6>
@endsection

@section('amorttbl_content')
    <!--blade template placeholder section, satisfies html validator requirements  -->
    <h6>&nbsp;</h6>
@endsection
