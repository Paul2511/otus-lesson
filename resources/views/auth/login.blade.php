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
          {{-- Logo --}}
          {{-- <div class="text-center"><img src="{{asset('assets/images/logo-sample.png')}}" alt=""></div> --}}
          {{-- Logo --}}
          <div class="card mt-4">
            <div class="card-body">
              <div class="text-center">
                <h4 class="mb-4">{{Str::upper(__('auth.login')) }}</h4>
                <h6>{{__('auth.enter') }}</h6>
              </div>
                {{-- Login form opens--}}
                {!! Form::open(['url' => 'foo/bar','class' => 'theme-form']) !!}
                <div class="form-group">
                  {!! Form::label('email', __('auth.yourEmail'), ['class' => 'col-form-label pt-0']) !!}
                  {!! Form::email('email', '', ['class' => 'form-control', 'required']) !!}
                </div>
                <div class="form-group">
                  {!! Form::label('password', __('auth.password'), ['class' => 'col-form-label']) !!}
                  {!! Form::password('password', ['class' => 'form-control', 'required']) !!}
                </div>
                <div class="checkbox p-0">
                  {!! Form::checkbox('remember','0', false, ['id' => 'remember']) !!}
                  {!! Form::label('remember', __('auth.remember'), ['for' => 'remember']) !!}
                </div>
                <div class="form-group form-row mt-3 mb-4">
                    {!! Form::submit( Str::ucfirst(__('auth.login')),['class' => 'btn btn-primary btn-block'] ) !!}
                </div>
                <hr>
                <div class="text-center">{!! __('auth.newUser') !!}</div>
                {!! Form::close() !!}
                {{-- Login form closes--}}
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
