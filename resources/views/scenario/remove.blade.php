{{-- /resources/views/index.blade.php --}}
@extends('layouts.master')

@section('title')
    Mortgage Payment Calculator
@endsection

@section('form_content')
 <h2>Remove Mortgage Scenario Information from Database</h2>

   <h3>Confirm deletion</h3>
       <form method='POST' action='/scenario/remove'>

           {{ csrf_field() }}

           <input type='hidden' name='id' value='{{ $scenario->id }}'?>

           <h2>Are you sure you want to remove this scenario from the database <em>{{ $scenario->scenario_name }}</em>?</h2>

           <input type='submit' value='Confirm Remove' class='btn btn-danger'>

       </form>


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
