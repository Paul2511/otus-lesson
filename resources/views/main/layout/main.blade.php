<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>@yield('title')</title>
        <link rel="stylesheet" href="{{ asset('assets/main/css/main.css') }}">
    </head>

    <body>
        @include('main/layout/navbar')
        @yield('content')

        <footer class="page-footer text-center font-small mt-4 wow fadeIn">
            <div class="pb-4 pt-4">
                <a href="https://github.com/otusteamedu/Laravel/tree/TLysak/master" target="_blank">
                    <i class="fab fa-github mr-3"></i>
                </a>
            </div>

            <div class="footer-copyright py-3">
                © 2020 Copyright
            </div>
        </footer>

        <script src="{{ asset('assets/main/js/main.js') }}"></script>
    </body>
</html>
