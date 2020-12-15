@extends('auth.layouts.master') 
@section('title',__('auth.login').' | '.__('app.name'))
@section('styles')
@endsection
@section('content')
<!-- login page start-->
<div class="authentication-main">
  <div class="row">
    <div class="col-md-12">
      <div class="auth-innerright">
        <div class="authentication-box">
{{--           Logo--}}
{{--           <div class="text-center"><img src="{{asset('assets/images/logo-sample.png')}}" alt=""></div>--}}
{{--           Logo--}}
          <div class="card mt-4">
            <div class="card-body">
              <div class="text-center">
                <h4 class="mb-4">{{Str::upper(__('messages.auth.login')) }}</h4>
                <h6>{{__('messages.auth.enter') }}</h6>
              </div>
                {{-- Login form opens--}}
                {!! Form::open(['route' => ['login', 'locale'=>App::getLocale()],'method' => 'post', 'class' => 'theme-form']) !!}
                <div class="form-group">
                  {!! Form::label('email', __('messages.auth.yourEmail'), ['class' => 'col-form-label pt-0']) !!}
                  {!! Form::email('email', '', ['class' => 'form-control'.($errors->has('email') ? ' is-invalid' : null), 'required']) !!}
                  @error('email')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>
                <div class="form-group">
                  {!! Form::label('password', __('messages.auth.password'), ['class' => 'col-form-label']) !!}
                  {!! Form::password('password', ['class' => 'form-control'.($errors->has('password') ? ' is-invalid' : null), 'required']) !!}
                  @error('password')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>
                <div class="checkbox p-0">
                  {!! Form::checkbox('remember','0', false, ['id' => 'remember']) !!}
                  {!! Form::label('remember', __('messages.auth.remember'), ['for' => 'remember']) !!}
                </div>
                <div class="form-group form-row mt-3 mb-4">
                    {!! Form::submit( Str::ucfirst(__('messages.auth.login')),['class' => 'btn btn-primary btn-block'] ) !!}
                </div>
                <hr>
                <div class="text-center">{!! __('messages.auth.newUser') !!}</div>

                {!! Form::close() !!}
                {{-- Login form closes--}}
              <div class="text-center mt-4"><a class="txt-dark" href="{{ route('password.request', app()->getLocale()) }}">{{ __('messages.auth.forgot') }}</a></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- login page end-->
@endsection
@section('layouts._scripts')
@endsection
