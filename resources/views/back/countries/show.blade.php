@extends('back.layouts.app')

@section('title', $country->name)

@extends('back.blocks.navbar')

@section('content')

    <div class="mt-1">
        <a class="text-blue-600 hover:text-black" href="{{ route(\App\Services\Routes\Providers\Admin\AdminRoutes::ADMIN_COUNTRIES_INDEX) }}">
            @lang('messages.back')
        </a>
    </div>

    <div class="bg-white mx-auto my-5 rounded-lg shadow overflow-hidden">
        <div class="m-6">
            <p><b>@lang('messages.title'):</b> {{ $country->name }}</p>
            <p><b>@lang('messages.continent_name'):</b> {{ $country->continent_name }}</p>
            <p><b>@lang('messages.description'):</b> {{ $country->description }}</p>
            <p><b>@lang('messages.status'):</b> {{ $country->status }}</p>
            <p><b>@lang('messages.created'):</b> {{ $country->created_at }}</p>
            <p><b>@lang('messages.updated'):</b> {{ $country->updated_at }}</p>
        </div>

        <div class="m-6">
            <a class="whitespace-nowrap inline-flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-base font-medium text-white bg-indigo-600 hover:bg-indigo-700"
               href="{{ route(\App\Services\Routes\Providers\Admin\AdminRoutes::ADMIN_COUNTRIES_EDIT, $country) }}"
               role="button">@lang('navs.edit')</a>
        </div>
    </div>

@endsection
