@extends('public.layouts._page')

@section('title', trans('views.auth_title'))

@section('content')
    <p class="lead">@lang('views.auth_lead')</p>

    {{ Form::open() }}
    <div class="row">
        <div class="col-sm-12 col-md-6 col-lg-6">
            <div class="form-group">
                {{ Form::label('login', trans('views.auth_form_field_login')) }}
                {{ Form::text('login', null, ['class' => 'form-control']) }}
            </div>
        </div>
        <div class="col-sm-12 col-md-6 col-lg-6">
            <div class="form-group">
                {{ Form::label('pass', trans('views.auth_form_field_pass')) }}
                {{ Form::text('pass', null, ['class' => 'form-control', 'type' => 'password']) }}
            </div>
        </div>
    </div>
    <div class="form-group">
        {{ Form::submit(trans('views.auth_form_submit'), ['class' => 'btn btn-success']) }}
    </div>
    {{ Form::token() }}
    {{ Form::close() }}
@endsection


