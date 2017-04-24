<!DOCTYPE html>
<html lang="en">
<!--head-->
<head>
    <title>
        @yield('title', 'Mortgage_Calculator')
    </title>
    <meta charset='utf-8'>
    <!--referenced css style libs-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootswatch/3.3.7/flatly/bootstrap.min.css">
    <link rel="stylesheet" href="/css/mortcalc.css">
        @stack('head')
</head>
<!--start of html body -->
  <body>

      <header>

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
              <p><a href="/readme">Read Me</a></p>
      </footer>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

    @stack('body')

  </body>
</html>
