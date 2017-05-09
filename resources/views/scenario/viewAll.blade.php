{{-- /resources/views/scenario/viewAll.blade.php --}}
{{-- blade view to all loan scenarios saved in the database --}}

@extends('layouts.master')

@section('title')
  View all Mortgage Loan Scenarios
@endsection

@section('form_content')
  <h4>Mortgage Payments - All Scenarios Saved in the database</h4>
  {{-- Reference: Used outside package 'laravel tables' from gbrock -> https://github.com/gbrock/laravel-table --}}
  <table> {!! $table->render() !!} </table>

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
