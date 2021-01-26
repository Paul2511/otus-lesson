@extends('layouts.index')

@section('title',"ToDo Service")

@section('content')
    <div class="container">
        @guest
        @else
            <div class="row">
                <div class="action-panel">
                    <button class="btn btn-outline-primary" data-toggle="modal"
                            data-target="#add_column">@lang('button.add column')</button>
                    @include('blocks.modals.add-column')

                    <button class="btn btn-outline-danger" data-toggle="modal"
                            data-target="#remove_column">@lang('button.remove column')</button>
                    @include('blocks.modals.remove-column',['columns' => $columns])
                </div>
            </div>
        @endguest
        <div class="row">
            @foreach($columns as $column)
                <div class="col-lg-3">
                    <div class="column">
                        <div class="column__header">
                            <p class="column__title">{{$column->title}}</p>
                            @guest
                            @else
                                <div class="action-column">
                                    <button class="btn btn-outline-primary action-column__add" data-toggle="modal"
                                            data-target="#add_task">+
                                    </button>
                                    @include('blocks.modals.add-task')
                                </div>
                            @endguest
                        </div>
                        <div class="column__body">
                            @foreach($column->tasks as $task)
                                <div class="card" data-toggle="modal" data-target="#cardBody-{{$task->id}}">
                                    <p class="card__title">{{$task->title}}</p>
                                    @include('blocks.card-inside',['id' => $task->id,'data' => $task])
                                </div>
                            @endforeach
                        </div>

                    </div>
                </div>
            @endforeach
        </div>
    </div>

@endsection
