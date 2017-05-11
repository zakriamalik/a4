{{-- /resources/views/scenario/search.blade.php --}}
{{-- blade view to searche loan scenario saved in the database and display using table package; leveraged class notes http://dwa15.com --}}

@extends('layouts.master')

@section('title')
    Search for specific loan scenario
@endsection

@section('form_content')
  <h4>Search Mortgage Loan Scenario</h4>

  <form method='GET' id='formSearch' action='/scenario/search'>
      <!-- text input for searching loan scenario name-->
      <label for='searchText'>Search by Scenario*:</label>
      <input type='text' id='searchText' name='searchText' required pattern='[a-zA-Z0-9]+' value= {{ isset($_GET['searchText']) ? $_GET['searchText'] : '' }} {{ old('searchText')}} ><br/>
      <!-- Reference for text input patter validation http://stackoverflow.com/questions/19619428/html5-form-validation-pattern-alphanumeric-with-spaces-->
      <!-- checkbox for making a case sensitive search. leveraged class notes http://dwa15.com  -->
      <label>Case Sensitive Search</label>
      <input type='checkbox' name='caseSensitive' {{ isset($_GET['caseSensitive']) ? 'checked' : ''}} {{ old('caseSensitive') ? 'CHECKED' : '' }} ><br/>
      <!-- similar word search based upon above technique-->
      <label>Similar Word Search</label>
      <input type='checkbox' name='similarSearch' {{ isset($_GET['similarSearch']) ? 'checked' : ''}} {{ old('similarSearch') ? 'CHECKED' : '' }} ><br/>
      <!-- submit & reset buttons-->
      <input type='submit' class='btn btn-primary btn-small' value='Search'>
      <input type='button' name='reset' class='btn btn-primary btn-small' onclick="parent.location='search'" value='Reset Form'>
      <!--Reference: Technique for reset button, got ideas from Piazza forum and this website:
      http://www.plus2net.com/html_tutorial/button-linking.php -->

  </form>
@endsection

@section('error_content')
    <!--check for validation errors, if found, display and hald calculations, code leveraged from class lecture notes -->
    <h6>&nbsp;</h6>
      {{-- @if($_GET && count($errors) > 0)
        <h4>Data entry error found. See below: </h4>
          <ul>
              @foreach ($errors->all() as $error)
                  <li>{{ $error }} </li>
              @endforeach
          </ul>
      @endif --}}
@endsection


@section('mortcalc_content')
  <h6>&nbsp;</h6>
    {{-- If the form was submitted, display the results: --}}
    @if($_GET && count($errors) == 0)
        <h2>Results for query of text: <em>{{ $searchText }}</em></h2>

        @if(count($searchResults) == 0)
            No matches found.
        @else
            <h3>Mortgage Loan Scenarios found: {{ $resultCount }}</h3>
            <table> {!! $table->render() !!} </table>

        @endif
    @endif
@endsection

@section('loancost_content')
  <h6>&nbsp;</h6>
@endsection

@section('amorttbl_content')
  <h6>&nbsp;</h6>
  <p>*search word must be alpha numberic only</P>
@endsection
