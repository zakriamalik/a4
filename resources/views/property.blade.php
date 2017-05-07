{{-- /resources/views/scenario.blade.php --}}
@extends('layouts.master')

@section('title')
    Real Estate Property List Management
@endsection

@section('form_content')
 <h2>Real Estate Property List Management</h2>
    <!--List of scenarios displayed for user to click select for respective CRUD database actions -->
    <ul>
      <a href="{{ url('/property','viewAll') }}">ViewAll Saved Properties</a></br>
      <a href="{{ url('/property','view') }}">View a single Property</a></br>
      <a href="{{ url('/property','save') }}">Save a New Properties</a></br>
      <a href="{{ url('/property','change') }}">Update an Existing Property</a></br>
      <a href="{{ url('/property','delete') }}">Remove an Existing Property</a></br>
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
    <!--Hosting url/hyperlink back to the Mortgage Payment Calculator -->
    <h6>&nbsp;</h6>
    <p><a href="/index.php">Mortgage Payment Calculator</a></p>
@endsection

@section('amorttbl_content')
    <!--blade template placeholder section, satisfies html validator requirements  -->
    <h6>&nbsp;</h6>
@endsection
