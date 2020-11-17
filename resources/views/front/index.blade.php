@extends('front.layouts.app')

@section('title', __('navs.home'))

@section('content')
    <h1>@lang('messages.h1_main_page')</h1>
    @lang('messages.content_main_page')
@endsection
