{{-- /resources/views/index.blade.php --}}
@extends('layouts.master')

@section('title')
    Mortgage Payment Calculator
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
