<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    {{--   Общие мета данные --}}
    @include('blocks.meta')
    {{--   Мета данные для конкретной страницы --}}
    @stack('meta')

    <title>@yield('title')</title>

    <script async src="{{ asset('js/app.js') }}"></script>

    @include('blocks.styles')
</head>
<body>
@include('blocks.header')
<main>
    <div id="app">
        <main class="py-1">
            @yield('content')
        </main>
    </div>
</main>
@include('blocks.footer')
@stack('scripts')
</body>
</html>
