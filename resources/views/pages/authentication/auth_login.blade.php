@extends('layouts.app')

@section('content')

    <div class="form-container">
        <div class="form-form">
            <div class="form-form-wrap">
                <div class="form-container">
                    <div class="form-content">

                        <h1 class=""> @lang('auth.login') <a href="https://smter.ru/"><span class="brand-name">SMARTER</span></a></h1>
                        <form class="text-left">
                            <div class="form">

                                <div id="username-field" class="field-wrapper input">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                                    <input id="username" name="username" type="text" class="form-control" placeholder=" @lang('auth.username') ">
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
                                        <button type="button" class="btn btn-primary" value=""> @lang('auth.log_in')</button>
                                    </div>

                                </div>

                                <div class="field-wrapper text-center keep-logged-in">
                                    <div class="n-chk new-checkbox checkbox-outline-secondary">
                                        <label class="new-control new-checkbox checkbox-outline-secondary">
                                          <input type="checkbox" class="new-control-input">
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

@endsection


