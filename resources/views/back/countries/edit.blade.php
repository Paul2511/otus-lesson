@extends('back.layouts.app')

@section('title', __('messages.edit_country')." ".$country->name)

@extends('back.blocks.navbar')

@section('content')

    @include('back.countries.blocks.header.edit', $country)
    @include('back.countries.blocks.form.edit')

@endsection
