@extends('layouts.app')

@section('content')
    @include('blocks.breadcrumb')

    <div class="container mt-4">
        <h1>{{ __('Тренировка') }}: Мой словарь <span class="badge badge-pill badge-primary">2 / 14</span></h1>
    </div>

    <div class="container mt-4">
        <div class="row justify-content-left">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Новое слово</div>

                    <div class="card-body">
                        <div class="text-center">
                            <p>What am i being <b>accused</b> of?</p>
                        </div>

                        <div class="mt-3 text-center">
                            <button type="button" class="btn btn-primary">
                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-eye" fill="currentColor"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                          d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.134 13.134 0 0 0 1.66 2.043C4.12 11.332 5.88 12.5 8 12.5c2.12 0 3.879-1.168 5.168-2.457A13.134 13.134 0 0 0 14.828 8a13.133 13.133 0 0 0-1.66-2.043C11.879 4.668 10.119 3.5 8 3.5c-2.12 0-3.879 1.168-5.168 2.457A13.133 13.133 0 0 0 1.172 8z"/>
                                    <path fill-rule="evenodd"
                                          d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
                                </svg>
                            </button>
                        </div>

                        <div class="mt-3 d-flex justify-content-between">
                            <button type="button" class="btn btn-success">{{ __('Я знаю это слово, пропустить') }}</button>
                            <button type="button" class="btn btn-danger">{{ __('Я не знаю это слово, изучать') }}</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container mt-4">
        <button type="button" class="btn btn-primary">{{ __('Закончить тренировку') }}</button>
    </div>
@endsection
