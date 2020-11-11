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
@include('public.parts.header')
@yield('content')
@include('public.parts.svg')
@include('public.parts.footer')
</body>
</html>
