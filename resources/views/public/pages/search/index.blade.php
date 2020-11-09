@extends('public.layouts.app')

@section('title', trans('views.search_title'))

@section('content')
    <p class="lead">@lang('views.search_lead')</p>
    <p class="lead">@lang('views.search_query', ['query' => Request::get('q')])</p>
@endsection


