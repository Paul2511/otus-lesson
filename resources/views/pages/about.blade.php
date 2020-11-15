@extends('layout.app')

@section('title', 'About page')

@section('content')
    <p>{{ __('about.message') }}</p>
    <p>{{ __('about.some_text') }}</p>
@endsection
