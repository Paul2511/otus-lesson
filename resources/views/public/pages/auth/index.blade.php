@extends('public.layouts.app')

@section('title', trans('views.auth_title'))

@section('content')
    <p class="lead">@lang('views.auth_lead')</p>

    @include('public.pages.auth.form.index')

@endsection


