@extends('layouts.main')

@section('title', 'User register')

@section('content')
    <p>{{  __('register.message') }}</p>

    {!! Form::open([]) !!}

    <div class="form-group">
        {{Form::label('name', __('register.name'))}}
        {{Form::text("name", null, ['class' => 'form-control'])}}
    </div>

    <div class="form-group">
        {{Form::label('email', __('register.email'))}}
        {{Form::text("email", null, ['class' => 'form-control'])}}
    </div>
    {{Form::submit( __('register.submit'), ['class' => 'btn btn-primary'])}}

    {!! Form::close() !!}


@endsection
