<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @yield('meta_data')
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}" defer></script>
    @yield('scripts')

<!-- Styles -->
    <link href="{{ mix('css/app.css')."?v=".time() }}" rel="stylesheet">
    @yield('css')
</head>
<body>
@include('frontEnd.parts.header')
@yield('content')
@include('frontEnd.parts.svg')
@include('frontEnd.parts.footer')
</body>
</html>
