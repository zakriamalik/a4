{{-- /resources/views/readme.blade.php --}}
@extends('layouts.master')

@section('title')
  All Saved Proverty Listings Scenarios
@endsection

@section('form_content')
  <h4>Property Listings</h4>
  <table> {!! $table->render() !!} </table>
  <p><a href="/property">Property Landing Page</a></p>
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
