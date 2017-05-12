{{-- /resources/views/readme.blade.php --}}
@extends('layouts.master')

@section('title')
  Mortgage Payment Calculator
@endsection

@section('form_content')
  <h4>Assignment 4 - readme file</h4>
  <P>
  This assignment includes building an application that interacts and operates on a database. <br/>
  The solution includes a Mortgage Loan Scenario Management system working alongside with a Real Estate Property Listing Management system. <br/>
  The key objective of this Laravel application is to provide a utility to the user to help determine estimated mortgage payment upon entry of certain required inputs like loan amount, duration, interest rate, and interest type.<br/>
  Then, capability is provided to save that information in a database as a Mortgage Loan Scenario that is attached to a Real Estate Property Listing.<br/>
  Additional capabilities are provided for the users to view, create, update, and remove Mortgage Loan Scenarios. They can evaluate estimated down payment as well. <br/>
  Moreover capabilities are provided for the users to view, create, update, and remove a Real Estate Property Listing. <br/>
  There are key features made available to attach and detach with the property using the pivot join table. <br/>
  As far as the Mortgage Calculator is concerned, option is provided to find the statistics for the life of the loan such as cost of loan, avg rate, etc.<br/>
  Another feature provided is the Mortgage Amortization Schedule. This is a table that helps determines the loan payment schedule with visibility into the components of mortgage payment (interest and principal) and a burn-down table from start of initial loan amount down to zero loan amount. The table includes a month field that helps identify the month of the payment. The underlying assumption is that the first payment occurs in next month.<br/>
  Calculator Specifications and Use Guidance:<br/>
  1) The Loan amount is a numerical entry with a range set from $1 to $100 million<br/>
  2) The interest rate is also a numerical entry with a range from 1% to 25%, fractions up to three decimal spaces are accepted<br/>
  3) The loan duration is from 15 yrs to 40 yrs term, with 5 yr increments offered via dropdown<br/>
  4) If the interest rate type is fixed, calculator would use the entered interest rate as fixed throughout the amortization schedule.<br/>
  5) If the interest rate type is variable, calculator would use the entered interest rate as a seed to determine random interest rates +-1% as entered.<br/>
  6) In this calculator, the type of interest rate does not impact the monthly payments which are set to be fixed by design, however the type of interest rate impacts the amortization schedule such that if interest rate type is variable, the interest rate changes from month to month, thus impacting the amounts of interest and principal applied towards the loan balance. This results in either paying loan early or paying a large lump sum residual in the last payment.<br/>
  7) Checkboxes are provided in order to show the loan life time summary and amortization schedule in conjunction with submit button<br/>
  8) Reset button is provided to clear all entries and begin entries from scratch<br/>
  9) Validation is in place, both client side as well as severer side, to determine if the input entries are valid and be used for mathematical calculations<br/>
  </p>
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
