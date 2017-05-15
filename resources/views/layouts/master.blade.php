<!DOCTYPE html>
<html lang="en">
<!--head-->
<head>
    <title>
        @yield('title', 'Mortgage_Calculator')
    </title>
    <meta charset='utf-8'>
    <!--referenced css style libs-->
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
    <script src="http://canvasjs.com/assets/script/canvasjs.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootswatch/3.3.7/flatly/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" >
    <link rel="stylesheet" href="/css/mortcalc.css">

   {{--Java Script for hide/show misc features --}}
    <script type="text/javascript">
        $(document).ready(function(){
          $('#autoUpdate1').fadeOut('slow')
        $('#addMortInfo').change(function(){
        if($(this).is(":checked"))
        $('#autoUpdate1').fadeIn('slow');
        else
        $('#autoUpdate1').fadeOut('slow');
        });
        });

        $(document).ready(function(){
          $('#autoUpdate2').fadeOut('slow')
        $('#addMortAmort').change(function(){
        if($(this).is(":checked"))
        $('#autoUpdate2').fadeIn('slow');
        else
        $('#autoUpdate2').fadeOut('slow');
        });
        });

        $(document).ready(function(){
          $('#chartContainer').fadeOut('slow')
        $('#addMortChart').change(function(){
        if($(this).is(":checked"))
        $('#chartContainer').fadeIn('slow');
        else
        $('#chartContainer').fadeOut('slow');
        });
        });

        $(document).ready(function(){
          $('#chartContainer2').fadeOut('slow')
        $('#addMortChart2').change(function(){
        if($(this).is(":checked"))
        $('#chartContainer2').fadeIn('slow');
        else
        $('#chartContainer2').fadeOut('slow');
        });
        });

        $(document).ready(function(){
          $('#chartContainer3').fadeOut('slow')
        $('#addMortChart3').change(function(){
        if($(this).is(":checked"))
        $('#chartContainer3').fadeIn('slow');
        else
        $('#chartContainer3').fadeOut('slow');
        });
        });

    </script>
    <!-- Reference: Java script for click to show additional features levereged from this site.
    http://stackoverflow.com/questions/19447591/show-hide-div-when-checkbox-selected -->


        @stack('head')
</head>
<!--start of html body -->
  <body>
    <!-- Code to display session message; Leveraged class notes http://dwa15.com-->
    @if(Session::get('message') != null)
        <div class='message' id='message'> {{ Session::get('message') }}</div>
    @endif

      <header>
                <!-- Reference: Top navigation Code leveraged from w3schools.com. https://www.w3schools.com/howto/howto_js_topnav.asp -->
                <div class='horizontalNav' id='horizontalNav'>
                  <a href='/'>Home</a>
                  <a href='/calc'>Mortgage Payment </a>
                  <a href='/scenario'>Mortgage Scenario Information</a>
                  <a href='/property'>Real Estate Property Information</a>
                  <a href='/readme'>About</a>
                </div>
      </header>

          <section>
              @yield('form_content')
          </section>

          <section>
              @yield('error_content')
          </section>

          <section>
              @yield('mortcalc_content')
          </section>

          <section>
              @yield('loancost_content')
          </section>

          <section>
              @yield('amorttbl_content')
          </section>

      <footer>
              <hr>

      </footer>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

    @stack('body')

  </body>
</html>
