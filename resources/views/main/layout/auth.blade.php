<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>@yield('title')</title>
        <link rel="stylesheet" href="{{ asset('assets/main/css/main.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/main/css/landing.css') }}">
    </head>

    <body>
        @include('main/layout/navbar')

        <div class="view full-page-intro" style="background-image: url('https://mdbootstrap.com/img/Photos/Others/images/78.jpg'); background-repeat: no-repeat; background-size: cover;">
            <div class="mask rgba-black-light d-flex justify-content-center align-items-center">
                <div class="container">
                    <div class="row wow fadeIn">
                        <div class="col-md-6 mb-4 white-text text-center text-md-left">
                            <h1 class="display-4 font-weight-bold">Сервис подбора преподавателей</h1>
                        </div>

                        @yield('content')
                    </div>
                </div>
            </div>
        </div>

        <script src="{{ asset('assets/main/js/main.js') }}"></script>
    </body>
</html>
