@extends('layouts.index')

@section('title', __('about.about'))

@section('content')
    {{ Breadcrumbs::render('about') }}
    <div class="container">
        <div class="row ">
            <div class="jumbotron">
                <h1 class="display-4">@lang('about.todo title')</h1>
                <p class="lead">@lang('about.todo description')</p>
                <hr class="my-4">
                <a class="btn btn-primary btn-lg" href="{{ route('home') }}" role="button">@lang('button.start button')</a>
            </div>
        </div>
    </div>
@endsection
