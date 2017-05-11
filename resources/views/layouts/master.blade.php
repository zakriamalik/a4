<!DOCTYPE html>
<html lang="en">
<!--head-->
<head>
    <title>
        @yield('title', 'Mortgage_Calculator')
    </title>
    <meta charset='utf-8'>
    <!--referenced css style libs-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootswatch/3.3.7/flatly/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" >
    <link rel="stylesheet" href="/css/mortcalc.css">
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

    {{-- <script type="text/javascript">
    $(document).ready(function () {
        $('#checkbox1').change(function () {
            if (!this.checked)
            //  ^
               $('#autoUpdate').fadeIn('slow');
            else
                $('#autoUpdate').fadeOut('slow');
        });
    });
    </script> --}}
    {{-- http://stackoverflow.com/questions/19447591/show-hide-div-when-checkbox-selected --}}

    @stack('body')

  </body>
</html>
