<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required Meta Tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- Page Title -->
    <title>@yield('page_title') - {{ config('app.name', 'Laravel') }}</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{asset('./images/favicon.png')}}" type="image/x-icon">


    <!-- CSS Files -->
    <link rel="stylesheet" href="{{mix('css/frontend.css')}}">

    <!-- Custom Stylesheets -->
    @yield('page_custom_css')
</head>

<body>
<!-- Preloader Starts -->
@include('blocks.preloader.index')
<!-- Preloader End -->

<!-- Header Area Starts -->
<header class="header-area main-header">
    @include('blocks.navbar.index')
</header>
<!-- Header Area End -->

@yield('page_content');


<!-- Footer Area Starts -->
@include('blocks.footer.index')
<!-- Footer Area End -->


<!-- Javascript -->
<script src="{{mix('js/frontend.js')}}"></script>

<!-- Custom Scripts -->
@yield('page_custom_js')
</body>

</html>
