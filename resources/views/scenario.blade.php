{{-- /resources/views/scenario.blade.php --}}
@extends('layouts.master')

@section('title')
    Mortgage Loan Scenario Management
@endsection

@section('form_content')
 <h2>Mortgage Loan Scenario Management</h2>
    <!--List of scenarios displayed for user to click select for respective CRUD database actions -->
    <ul>
      <li><a href="{{ url('/scenario','viewAll') }}">ViewAll Saved Scenarios</a></li>
      <li><a href="{{ url('/scenario','view') }}">View a Saved Scenario</a></li>
      <li><a href="{{ url('/scenario','search') }}">Search a Saved Scenario</a></li>
      <li><a href="{{ url('/scenario','save') }}">Save a New Scenario</a></li>
      <li><a href="{{ url('/scenario','change') }}">Update an Existing Scenario</a></li>
      <li><a href="{{ url('/scenario','delete') }}">Remove an Existing Scenario</a></li>
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
@endsection

@section('amorttbl_content')
    <!--blade template placeholder section, satisfies html validator requirements  -->
    <h6>&nbsp;</h6>
@endsection
