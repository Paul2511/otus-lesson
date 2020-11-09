@extends('public.layouts.app')

@section('title', trans('views.reg_title'))

@section('content')
    <p class="lead">@lang('views.reg_lead')</p>

    @include('public.pages.register.form.index')
@endsection
