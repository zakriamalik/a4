{{-- /resources/views/index.blade.php --}}
@extends('layouts.master')

@section('title')
    Mortgage Loan Scenario and Property Management System
@endsection

@section('form_content')
  <h2>Welcome</h2>
  <P>
  The application includes a Mortgage Loan Scenario Management system working alongside with a Real Estate Property Listing Management system. <br/>
  The user can determine estimated mortgage payment upon entry of certain required inputs like loan amount, duration, interest rate, and interest type.<br/>
  This information can be saved as a scenario to a database and attached to a prospective real estate property listing (already saved in the database).<br/>
  The users can view, create, update, and remove Mortgage Loan Scenarios. They can evaluate estimated down payment as well as estimated closing costs. <br/>
  The users can view additional mortgage loan statics and a detail amortization schedule for saved scenario. <br/>
  The users can also view graphically the burn down chart ($ amounts vs timeline) of loan balance, interest payments and principal payments. <br/>
  Moreover capabilities are provided for the users to view, create, update, and remove a Real Estate Property Listing. <br/>
  There are key features made available to attach and detach with the property. <br/>
  </p>
@endsection


@section('error_content')
  <!--blade template placeholder section, satisfies html validator requirements  -->
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
