@extends('layouts.app')

@section('content')
    <section class="banner-area organic-breadcrumb">
        <div class="container">
            <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
                <div class="col-first">
                    <h1>@lang('common.register')</h1>
                    <nav class="d-flex align-items-center">
                        <a href="#">@lang('common.home')<span class="lnr lnr-arrow-right"></span></a>
                        <a href="#">@lang('common.register')</a>
                    </nav>
                </div>
            </div>
        </div>
    </section>

    <section class="login_box_area section_gap">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="login_box_img">
                        <img class="img-fluid" src="img/login.jpg" alt="">
                        <div class="hover">
                            <h4>@lang('auth.already_have_account')</h4>
                            <a class="primary-btn" href="#">@lang('common.login')</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="login_form_inner">
                        <h3>@lang('common.register')</h3>

                        <form method="POST" class="row login_form" action="#">
                            @csrf

                            <div class="col-md-12 form-group">
                                <input type="text" class="form-control" name="name" placeholder="@lang('auth.username')" onfocus="this.placeholder = ''" onblur="this.placeholder = '@lang('auth.username')'">
                            </div>

                            <div class="col-md-12 form-group">
                                <input type="email" class="form-control" name="email" placeholder="@lang('auth.email')" onfocus="this.placeholder = ''" onblur="this.placeholder = '@lang('auth.email')'">
                            </div>

                            <div class="col-md-12 form-group">
                                <input type="password" class="form-control" name="password" placeholder="@lang('auth.password')" onfocus="this.placeholder = ''" onblur="this.placeholder = '@lang('auth.password')'">
                            </div>

                            <div class="col-md-12 form-group">
                                <input id="password-confirm" type="password" class="form-control" placeholder="@lang('auth.password_confirmation')" name="password_confirmation" required autocomplete="new-password" onfocus="this.placeholder = ''" onblur="this.placeholder = '@lang('auth.password_confirmation')'">
                            </div>

                            <div class="col-md-12 form-group">
                                <button type="submit" value="submit" class="primary-btn">@lang('auth.join')</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection