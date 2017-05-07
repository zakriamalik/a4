{{-- /resources/views/readme.blade.php --}}
@extends('layouts.master')

@section('title')
  All Mortgage Payment Saved Scenarios
@endsection

@section('form_content')
  <h4>Mortgage Payments - All Scenarios</h4>
  <table> {!! $table->render() !!} </table>
  <p><a href="/scenario">Mortgage Scenario Landing Page</a></p>
  <p><a href="/index.php">Mortgage Payment Calculator</a></p>
@endsection

@section('error_content')
  <h6>&nbsp;</h6>
@endsection

@section('mortcalc_content')
  <h6>&nbsp;</h6>
@endsection

@section('loancost_content')
  <h6>&nbsp;</h6>
@endsection

@section('amorttbl_content')
  <h6>&nbsp;</h6>
@endsection
