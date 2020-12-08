<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>@lang('general.cms') {{ config('app.name', 'Laravel') }}</title>
        <!-- Scripts -->
        <script src="{{ mix('js/cms.js') }}" defer></script>
        @yield('js')
    <!-- Styles -->
        <link href="{{ mix('css/cms.css')."?v=".time() }}" rel="stylesheet">
        @yield('css')
    </head>
    <body class="loaded">
        <div>
            <div class="loader-wrapper">
                <div class="loader">Loading...</div>
            </div>
        </div>
        <div class="main-wrapper">
            @include('cms.parts.sidebar')
            <div class="page-wrapper">
                @include('cms.parts.top-header')
                <div class="page-content">
                    @yield('content')
                </div>
            </div>
            @include('cms.parts.footer')
        </div>
        @yield('script')
    </body>
</html>
