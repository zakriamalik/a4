{{-- /resources/views/property/viewAll.blade.php --}}
{{-- blade view to show all real estate property listings using table joins --}}

@extends('layouts.master')

@section('title')
    All Saved Real Estate Property Listings Scenario
@endsection

@section('form_content')
    <h4>Property Listings</h4>
    {!! $table->render() !!}
    {{-- Reference: Used outside package 'laravel tables' from gbrock -> https://github.com/gbrock/laravel-table --}}
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
