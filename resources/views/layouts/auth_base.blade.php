<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>GoPaperless </title>

    <link href="{{ asset('assets/vendors/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{ asset('assets/vendors/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
    <!-- NProgress -->
    <link href="{{ asset('assets/vendors/nprogress/nprogress.css')}}" rel="stylesheet">
     <!-- Animate.css -->
     <link href="{{ asset('assets/vendors/animate.css/animate.min.css')}}" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="{{ asset('assets/build/css/custom.min.css')}}" rel="stylesheet">

    <link href="{{asset('assets/my_css/style1.css')}}" rel="stylesheet">

  </head>

  <body class="login">
    <div class="wrapper">
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>

        @yield('content')
        @include('sweetalert::alert')

    </div>
  </body>
</html>
