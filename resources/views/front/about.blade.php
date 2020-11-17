@extends('front.layouts.app')

@section('title', __('navs.about'))

@section('content')
    <h1>@lang('messages.h1_about')</h1>
    @lang('messages.content_about')
@endsection
