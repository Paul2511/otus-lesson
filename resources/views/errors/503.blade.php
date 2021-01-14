<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>503 Error</title>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">

    <!-- Styles -->
    <link href="{{asset('assets/css/loader.css')}}" rel="stylesheet" type="text/css" />
    <script src="{{asset('assets/js/loader.js')}}"></script>

    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
    <link href="{{asset('bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    {{-- Pages Error 503 --}}
    <link href="{{asset('assets/css/plugins.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/css/pages/error/style-503.css')}}" rel="stylesheet" type="text/css" />
    <style>
        #content {
            width: 100%;
            margin-top: 0;
            margin-left: 0;
        }
    </style>

</head>
<body>

<!-- BEGIN LOADER -->
<div id="load_screen"> <div class="loader"> <div class="loader-content">
            <div class="spinner-grow align-self-center"></div>
        </div></div></div>
<!--  END LOADER -->


<!--  BEGIN MAIN CONTAINER  -->
<div class="main-container" id="container">

    <div class="overlay"></div>
    <div class="search-overlay"></div>

    <!--  BEGIN CONTENT PART  -->
    <div id="content" class="main-content">
        <div class="container-fluid"  style="text-align: center;">
            <div class="row">
                <div class="col-md-12 mr-auto mt-5 text-md-left text-center" style="text-align: center!important; margin-top: 6rem!important;">
                    <a href="/" class="ml-md-5" style="margin-left: 0!important;">
                        <img alt="image-503" src="{{asset('storage/img/90x90.jpg')}}" class="theme-logo" style="width: 160px;height: 160px; margin-left: 0!important;">
                    </a>
                </div>
            </div>
        </div>

        <div class="container-fluid error-content" style="text-align: center!important;">
            <div class="">
                <h1 class="error-number" style="font-size: 3.5rem !important;padding-top: 44px;">503</h1>
                <p class="mini-text" style="font-size: 1.875rem !important;">@lang('errors.Ooops')</p>
                <p class="error-text" style="font-size: 1.875rem !important;">@lang('errors.Unavailable')</p>
                <a href="/" class="btn btn-secondary mt-5">@lang('errors.Back')</a>
            </div>
        </div>
    </div>
    <!--  END CONTENT PART  -->

</div>
<!-- END MAIN CONTAINER -->

{{--@include('inc.scripts')--}}
<script src="{{asset('assets/js/libs/jquery-3.1.1.min.js')}}"></script>
<script src="{{asset('bootstrap/js/popper.min.js')}}"></script>
<script src="{{asset('bootstrap/js/bootstrap.min.js')}}"></script>

</body>
</html>
