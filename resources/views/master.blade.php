<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>O Livro Dahora</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="{{asset("css/linearicons.css")}}" />
    <link rel="stylesheet" href="{{asset("css/font-awesome.min.css")}}" />
    <link rel="stylesheet" href="{{asset("css/magnific-popup.css")}}" />
    <link rel="stylesheet" href="{{asset("css/nice-select.css")}}" />
    <link rel="stylesheet" href="{{asset("css/owl.carousel.css")}}" />
    <link rel="stylesheet" href="{{asset("css/bootstrap.css")}}" />
    <link rel="stylesheet" href="{{asset("css/bootstrap-datepicker.css")}}" />
    <link rel="stylesheet" href="{{asset("css/themify-icons.css")}}" />
    <link rel="stylesheet" href="{{asset("css/main.css")}}" />
    <link rel="stylesheet" href="{{asset("css/app.css")}}" />
    <script
            src="https://code.jquery.com/jquery-2.2.4.min.js"
            integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
            crossorigin="anonymous"></script>
</head>
<body>
    @include('static.header')
    <div id="app">
        @yield('content')
    </div>
    <script
            integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4"
            src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"
            crossorigin="anonymous"
    ></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="{{asset("js/owl.carousel.min.js")}}"></script>
    <script src="{{asset("js/jquery.sticky.js")}}"></script>
    <script src="{{asset("js/jquery.tabs.min.js")}}"></script>
    <script src="{{asset("js/parallax.min.js")}}"></script>
    <script src="{{asset("js/jquery.nice-select.min.js")}}"></script>
    <script src="{{asset("js/jquery.ajaxchimp.min.js")}}"></script>
    <script src="{{asset("js/jquery.magnific-popup.min.js")}}"></script>
    <script src="{{asset("js/bootstrap-datepicker.js")}}"></script>
    <script src="{{asset("js/jquery.mask.js")}}"></script>

    <script
            type="text/javascript"
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBhOdIF3Y9382fqJYt5I_sswSrEw5eihAA"
    ></script>
    <script src="{{asset("js/main.js")}}"></script>
    <script src="{{asset("js/app.js")}}"></script>
    @include('static.footer')
</body>
</html>