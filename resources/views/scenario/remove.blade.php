{{-- /resources/views/scenario/remove.blade.php --}}
{{-- blade view to remove a new loan scenario to the database; leveraged code from class notes http://dwa15.com --}}

@extends('layouts.master')

@section('title')
    Remove Mortgage Loan Scenario
@endsection

@section('form_content')
 <h2>Remove a Mortgage Loan Scenario Information from the Database</h2>

   <h3>Confirm deletion</h3>
      <!--start of form -->
       <form method='POST' action='/scenario/remove'>
            <!--CSRF protection code -->
           {{ csrf_field() }}
            <!--hidden input number field to track the scenario -->
           <input type='hidden' name='id' value='{{ $scenario->id }}'?>
           <!--Confirmation message for removal of record -->
           <h2>Are you sure you want to remove this scenario from the database <em>{{ $scenario->scenario_name }}</em>?</h2>
           <!--submit button to remove -->
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
