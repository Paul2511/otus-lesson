@extends('front.layouts.app')

@section('title', __('avs.home'))

@section('content')
    <h1>@lang('messages.h1_main_page')</h1>
    <p>Приветствуем на главной странице!</p>
    <p>Здесь будут выводиться несколько самых актуальных объявлений сайта</p>
@endsection
