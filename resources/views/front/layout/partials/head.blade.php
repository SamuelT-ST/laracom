<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title> LUMO.sk - Osvetlenie pre vašu domácnosť aj podnikanie </title>
    <!-- favicon -->
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <!-- bootstrap -->
    <link rel="stylesheet" href="{{asset('/css/bootstrap.min.css')}}">
    <!-- icofont -->
    <link rel="stylesheet" href="{{asset('/css/fontawesome.min.css')}}">
    <!-- animate.css -->
    <link rel="stylesheet" href="{{asset('/css/animate.css')}}">
    <!-- select 2  -->
    <link rel="stylesheet" href="{{asset('/css/select2.min.css')}}">
    <!-- Owl Carousel -->
    <link rel="stylesheet" href="{{asset('/css/owl.carousel.min.css')}}">
    <!-- magnific popup -->
    <link rel="stylesheet" href="{{asset('/css/magnific-popup.css')}}">
    <!-- stylesheet -->
    <link rel="stylesheet" href="{{asset('/css/style.css')}}">
    <!-- responsive -->
    <link rel="stylesheet" href="{{asset('/css/responsive.css')}}">

    <link rel="stylesheet" href="{{asset('/css/front.css')}}">

    @yield('head')

</head>
