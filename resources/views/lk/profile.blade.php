@extends('layout.app')

@section('title', 'User profile')

@section('content')
    <p>{{ __('profile.message') }}</p>

    @include('lk.card.index')

@endsection
