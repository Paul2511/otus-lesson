@extends('layouts.app')

@section('content')
    @include('blocks.breadcrumb', [
        'links' => [
            __('Домой') => route('home'),
            ],
        'current' => __('Словари')
    ])

    <div class="container mt-4">
        <h1>{{ __('Словари') }}</h1>
    </div>

    <div class="container mt-3">
        @foreach($dictionaries as $dictionary)
            <div class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
            <span>
                <a href="/dictionaries/{{ $dictionary->id }}">{{ $dictionary->name }}</a>
                <span class="badge badge-primary badge-pill">{{ $dictionary->words->count() }}</span>
            </span>
                <div>
                    <button type="button" class="btn btn-primary">{{ __('Начать тренировку') }}</button>

                    @include('blocks.forms.destroy', ['link' => route('dictionaries.destroy', [$dictionary->id])])
                </div>
            </div>
        @endforeach
    </div>

    <div class="container mt-3">
        {{ $dictionaries->links() }}
    </div>

    @include('blocks.forms.dictionaries-store')
@endsection
