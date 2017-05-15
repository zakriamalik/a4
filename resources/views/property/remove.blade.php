{{-- /resources/views/property/remove.blade.php --}}
{{-- blade view to remove a property listing from the database, code leveraged from class notes--}}

@extends('layouts.master')

@section('title')
    Real Estate Property Information
@endsection

@section('form_content')
 <h2>Remove a Real Estate Property Information from Database</h2>

   <h4>Confirm removal</h4>
       <!--start of form -->
       <form method='POST' action='/property/remove'>
           {{-- <!--cross site attack defence--> --}}
           {{ csrf_field() }}
           <!--hidden input box for property name to be maintained -->
           <input type='hidden' name='id' value='{{ $properties->id }}'>
           <!--Alert message to confirm if user want to remove this listing-->
           <h4>Associated Mortgage Loan Scenarios will also be deleted and Property Features detached.<br/>
             Are you sure you want to remove this property "<em>{{ $properties->property_name }}</em>" from the database?</h4>
           <!--submit red button to confirm removal of feature-->
           <input type='submit' value='Confirm Remove' class='btn btn-danger'>

       </form>

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
