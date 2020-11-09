@extends('public.layouts.app')

@section('title', trans('views.account_title'))

@section('content')
    <p class="lead">@lang('views.account_lead')</p>

    <div class="jumbotron">
        <h1 class="display-4">@lang('views.account_welcome', ['user' => 'Username'])</h1>
        <p class="lead">@lang('views.account_lead')</p>
        <hr class="my-4">
        <p>@lang('views.account_info')</p>
        <a class="btn btn-primary btn-lg" href="#" role="button">@lang('views.account_learn_link')</a>
    </div>

    <hr class="my-4">

    @include('public.pages.accounts.form.edit-form')

@endsection
