@extends('back.layouts.app')

@section('title', __('messages.dashboard'))

@extends('back.blocks.navbar', ['activeMenu' => 'dashboard'])

@section('content')

    @include('back.blocks.dashboard.index')

@endsection
