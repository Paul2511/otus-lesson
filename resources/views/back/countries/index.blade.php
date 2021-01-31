@extends('back.layouts.app')

@section('title', __('messages.countries'))

@extends('back.blocks.navbar', ['activeMenu' => 'countries'])

@section('content')

    @include('back.countries.blocks.header.list')

    <div class="bg-white mx-auto my-5 rounded-lg shadow overflow-hidden">
        <div class="m-6">
            @include('back.countries.blocks.list.index', $countries)
        </div>
    </div>

@endsection
