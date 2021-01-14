<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title><x-app-title page-name="{{ $page_name }}"/></title>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">

    <!-- Styles -->
    <link href="{{asset('assets/css/loader.css')}}" rel="stylesheet" type="text/css" />
    <script src="{{asset('assets/js/loader.js')}}"></script>

    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
    <link href="{{asset('bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('assets/css/main.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('assets/css/authentication/form-1.css')}}" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" type="text/css" href="{{asset('assets/css/forms/theme-checkbox-radio.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('assets/css/forms/switches.css')}}">

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
        <div class="form-container">
            <div class="form-form">
                <div class="form-form-wrap">
                    <div class="form-container">
                        <div class="form-content">

                            <h1 class=""> @lang('auth.login') <a href="https://smter.ru/"><span class="brand-name">SMARTER</span></a></h1>
                            <h6 id="error_message" style="text-align: center;font-size: 14px;color: red;"></h6>
                            <form class="text-left">
                                <div class="form">
{{--                                    <input name="_token" type="hidden" value="{{ csrf_token() }}">--}}
                                    <div id="username-field" class="field-wrapper input">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                                        <input id="email" name="email" type="text" class="form-control" placeholder=" @lang('auth.username') ">
                                    </div>

                                    <div id="password-field" class="field-wrapper input mb-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-lock"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                                        <input id="password" name="password" type="password" class="form-control" placeholder=" @lang('auth.password') ">
                                    </div>
                                    <div class="d-sm-flex justify-content-between">
                                        <div class="field-wrapper toggle-pass">
                                            <p class="d-inline-block"> @lang('auth.show_pass') </p>
                                            <label class="switch s-secondary">
                                                <input type="checkbox" id="toggle-password" class="d-none">
                                                <span class="slider round"></span>
                                            </label>
                                        </div>
                                        <div class="field-wrapper">
                                            <button type="button" class="btn btn-primary" id="login" value=""> @lang('auth.log_in')</button>
                                        </div>

                                    </div>

                                    <div class="field-wrapper text-center keep-logged-in">
                                        <div class="n-chk new-checkbox checkbox-outline-secondary">
                                            <label class="new-control new-checkbox checkbox-outline-secondary">
                                                <input type="checkbox" class="new-control-input" id="remember" name="remember" value=1>
                                                <span class="new-control-indicator"></span>@lang('auth.keep')
                                            </label>
                                        </div>
                                    </div>

                                    <div class="field-wrapper">
                                        <a href="" class="forgot-pass-link">@lang('auth.forgot')</a>
                                    </div>
                                    <div class="field-wrapper" style="text-align: center">
                                        @include('inc.lang')
                                    </div>

                                </div>
                            </form>
                            @include('inc.copyright')
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-image">
                <div class="l-image">
                </div>
            </div>
        </div>
    </div>
    <!--  END CONTENT PART  -->

</div>

{{--@include('inc.scripts')--}}
<script src="{{asset('assets/js/libs/jquery-3.1.1.min.js')}}"></script>
<script src="{{asset('bootstrap/js/popper.min.js')}}"></script>
<script src="{{asset('bootstrap/js/bootstrap.min.js')}}"></script>
<script src="{{asset('assets/js/authentication/form-1.js')}}"></script>
<!-- END MAIN CONTAINER -->
<script>
    jQuery(document).ready(function ($) {
        var route_login = '{{route(\App\Services\Routes\Providers\Auth\AuthRoutes::AUTH_LOGIN)}}';
        $('#login').click(function (e) {
            var email = $('#email').val();
            var password = $('#password').val();
            var remember =0;
            if($("#remember").prop('checked')) {
                remember = 1;
            }
            $.ajax({
                type: 'POST',
                beforeSend: function (xhr) { // Add this line
                    xhr.setRequestHeader('X-CSRF-Token', $('[name="_token"]').val());
                },  // Add this line
                url: route_login,
                data: {email: email, password: password, remember:remember },
                dataType: 'json',
                success: function (respond) {
                  window.location.reload();
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    $('#error_message').html(jqXHR.responseJSON.message);
                }
            });
        });

    });
</script>
</body>
</html>




