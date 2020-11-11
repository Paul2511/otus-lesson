@extends('public.layouts.app')
@section('content')
    <div class="container pt-5 pb-5">
        <div class="login_page">
            <h2 class="text-center">@lang('auth.account_authentication')</h2>
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success')}}
                </div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger">
                    {!! session('error') !!}
                </div>
            @endif
            <div>
                <form role="form" method="POST" action="{{ route('login') }}" class="m-auto w-50">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="exampleInputEmail1">@lang('base.email')</label>
                        <input type="email" class="form-control" id="email" placeholder="@lang('base.email')" value="{{ old('email') }}">
                        @if ($errors->has('email'))
                            <div class="alert alert-danger">
                                <strong>{{ $errors->first('email') }}</strong>
                            </div>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">@lang('base.password')</label>
                        <input type="password" class="form-control" id="password" placeholder="@lang('base.password')" value="{{ old('password') }}">
                        @if ($errors->has('password'))
                            <div class="alert alert-danger">
                                <strong>{{ $errors->first('password') }}</strong>
                            </div>
                        @endif
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-success">
                            @lang('auth.sign_in')
                        </button>
                    </div>
                    <div>
                        <a href="{{ route('password.request') }}">@lang('auth.forgot_your_password')</a>
                    </div>
                </form>

                <div class="text-center pt-5 pb-5">
                    <svg class="mt-1 mr-3" width="75" height="75">
                        <use xlink:href="#login"></use>
                    </svg>
                    <h3 class="page-title">@lang('auth.do_not_have_account')</h3>
                    <h3><a class="btn btn-outline-info" href="{{route('register')}}">@lang('auth.register_here')</a></h3>
                </div>
            </div>
        </div>
    </div>
@endsection

