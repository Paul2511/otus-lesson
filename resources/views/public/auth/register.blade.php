@extends('public.layouts.app')
@section('content')
    <div class="container pt-5 pb-5">
        <div class="login_page">
            <h2 class="text-center">@lang('auth.account_registration')</h2>
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
                <form role="form" method="POST" action="{{ route('register') }}" class="m-auto w-50">
                    @method('POST')
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="first_name">@lang('base.first_name')</label>
                        <input type="text" class="form-control" id="first_name" placeholder="@lang('base.first_name')" value="{{ old('first_name') }}">
                        @if ($errors->has('first_name'))
                            <div class="alert alert-danger">
                                <strong>{{ $errors->first('first_name') }}</strong>
                            </div>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="last_name">@lang('base.last_name')</label>
                        <input type="text" class="form-control" id="last_name" placeholder="@lang('base.last_name')" value="{{ old('last_name') }}">
                        @if ($errors->has('last_name'))
                            <div class="alert alert-danger">
                                <strong>{{ $errors->first('last_name') }}</strong>
                            </div>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="email">@lang('base.email')</label>
                        <input type="email" class="form-control" id="email" placeholder="@lang('base.email')" value="{{ old('email') }}">
                        @if ($errors->has('email'))
                            <div class="alert alert-danger">
                                <strong>{{ $errors->first('email') }}</strong>
                            </div>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="password">@lang('base.password')</label>
                        <input type="password" class="form-control" id="password" placeholder="@lang('base.password')" value="{{ old('password') }}">
                        @if ($errors->has('password'))
                            <div class="alert alert-danger">
                                <strong>{{ $errors->first('password') }}</strong>
                            </div>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="password_repeat">@lang('base.password_repeat')</label>
                        <input type="password" class="form-control" id="password_repeat" placeholder="@lang('base.password_repeat')" value="{{ old('password_repeat') }}">
                        @if ($errors->has('password_repeat'))
                            <div class="alert alert-danger">
                                <strong>{{ $errors->first('password_repeat') }}</strong>
                            </div>
                        @endif
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-success">
                            @lang('auth.register')
                        </button>
                    </div>
                </form>

                <div class="text-center pt-5 pb-5">
                    <svg class="mt-1 mr-3" width="75" height="75">
                        <use xlink:href="#login"></use>
                    </svg>
                    <h3 class="page-title">@lang('auth.do_have_account')</h3>
                        <h3><a class="btn btn-outline-info" href="{{route('login')}}">@lang('auth.login_here')</a></h3>
                </div>
            </div>
        </div>
    </div>
@endsection

