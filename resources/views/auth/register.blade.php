@extends('auth.layouts.master')
@section('title',__('auth.register').' | '.__('app.name'))
@section('styles')

@endsection

@section('content')
<div class="container-fluid">
  <!-- sign up page start-->
  <div class="authentication-main">
    <div class="row">
      <div class="col-sm-12 p-0">
        <div class="auth-innerright">
          <div class="authentication-box">
            {{-- <div class="text-center"><img src="{{asset('assets/images/sample-logo.png')}}" alt=""></div> --}}
            <div class="card mt-4 p-4">
              <h4 class="text-center mb-4">{{ Str::upper(__('auth.register')) }}</h4>
              <h6 class="text-center">{{ __('auth.newEnter') }}</h6>
              {{-- Register form starts --}}
              {!! Form::open(['url' => 'users/register','class' => 'theme-form']) !!}
                <div class="form-row">
                  <div class="col-md-6">
                    <div class="form-group">
                  {!! Form::label('firstName',  __('auth.firstName'), ['class' => 'col-form-label']) !!}
                  {!! Form::text('firstName', '', ['class' => 'form-control', 'placeholder' => __('auth.firstName'), 'required']) !!}
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                  {!! Form::label('lastName',  __('auth.lastName'), ['class' => 'col-form-label']) !!}
                  {!! Form::text('lastName', '', ['class' => 'form-control', 'placeholder' => __('auth.lastName'), 'required']) !!}
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  {!! Form::label('email', __('auth.email'), ['class' => 'col-form-label']) !!}
                  {!! Form::email('email', '', ['class' => 'form-control', 'placeholder' => 'your-email@domain.com', 'required']) !!}
                </div>
                <div class="form-group">
                  {!! Form::label('password', __('auth.password'), ['class' => 'col-form-label']) !!}
                  {!! Form::password('password', ['class' => 'form-control', 'required']) !!}
                </div>
                <div class="form-group">
                  {!! Form::label('confirm', __('auth.confirm'), ['class' => 'col-form-label']) !!}
                  {!! Form::password('confirm', ['class' => 'form-control', 'required']) !!}
                </div>
                <div class="form-row">
                  <div class="form-group form-row mt-3 mb-4 ml-2">
                      {!! Form::submit( Str::ucfirst(__('auth.signup')),['class' => 'btn btn-primary btn-block'] ) !!}
                  </div>
                  <div class="col-sm-8">
                    <div class="text-left mt-4 m-l-30">{{ __('auth.already') }} <a class="btn-link text-capitalize" href="/login">{{ __('auth.login') }}</a></div>
                  </div>
                </div>
                {!! Form::close() !!}
                {{-- Login form ends--}}
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- sign up page ends-->
</div>
@endsection
@section('scripts')
@endsection
