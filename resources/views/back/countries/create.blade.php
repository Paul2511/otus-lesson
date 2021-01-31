@extends('back.layouts.app')

@section('title', __('messages.add_country'))

@extends('back.blocks.navbar')

@section('content')

        @include('back.countries.blocks.header.create')
        @include('back.countries.blocks.form.create')

@endsection
