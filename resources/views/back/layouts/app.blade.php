<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>@yield('title') - adpl.ru</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/admin/app.css') }}" rel="stylesheet">
    @yield('styles')
</head>
<body class="bg-gray-200">

<div class="container mx-auto px-4">
    @yield('content')
</div>

<div class="container mx-auto px-4">
    @include('back.blocks.footer')
</div>

<script src="{{ mix('/js/app.js') }}"></script>
@stack('scripts')

</body>
</html>
