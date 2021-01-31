@extends('layouts.main')

@section('title', 'User profile')

@section('content')
    <p>{{ __('profile.message') }}</p>

    @include('profile.card.index')

@endsection
