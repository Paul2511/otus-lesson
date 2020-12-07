@extends('layouts.app')

@section('content')
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/home">{{ __('Домой') }}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ __('Словари') }}</li>
            </ol>
        </nav>
    </div>

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

                    <form action="/dictionaries/{{ $dictionary->id }}"
                          method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                class="btn btn-danger">
                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-trash"
                                 fill="currentColor"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"></path>
                                <path fill-rule="evenodd"
                                      d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"></path>
                            </svg>
                        </button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>

    @include('blocks.forms.new-dictionary')
@endsection
