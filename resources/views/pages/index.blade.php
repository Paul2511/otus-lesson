@extends('layouts.index')

@section('title',"ToDo Service")

@section('content')
    <div class="container">

        <div class="row">
            <div class="col-lg-3">
                <div class="column">
                    <div class="column__header">
                        <p class="column__title">ToDo</p>
                    </div>
                    <div class="column__body">
                        <div class="card" data-toggle="modal" data-target="#cardBody-1">
                            <p class="card__title">Сверстать главную</p>
                            @include('blocks.card-inside',['id' => 1,'title' => 'Сверстать главную'])
                        </div>
                        <div class="card" data-toggle="modal" data-target="#cardBody-2">
                            <p class="card__title">Сверстать страницу входа</p>
                            @include('blocks.card-inside',['id' => 2,'title' => 'Сверстать страницу входа'])
                        </div>
                    </div>

                </div>
            </div>


        </div>
    </div>

@endsection
