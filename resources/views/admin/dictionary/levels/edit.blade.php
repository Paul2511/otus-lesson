@extends('admin.layouts.main')

@section('content')
    @php
        $title = 'Редактирование уровня';
        $breadcrumbs[] = ['url' => route('admin.index'), 'title' => 'Главная'];
        $breadcrumbs[] = ['url' => route('levels.index'), 'title' => 'Уровни владения'];
        $breadcrumbs[] = ['url' => '#', 'title' => $title];
    @endphp
    @include('admin.blocks.breadcrumbs.index', ['breadcrumbs' => $breadcrumbs, $title])

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">{{ $level->title }}</h3>
                        </div>

                        <form role="form" method="post" action="{{ route('levels.update', ['level' => $level->id]) }}">
                            @csrf
                            @method('PUT')

                            <div class="card-body">
                                <div class="form-group">
                                    <label for="title">Название</label>
                                    <input type="text" name="title" class="form-control @error('title')is-invalid @enderror"
                                           id="title"
                                           placeholder="Название"
                                           value="{{ $level->title }}"
                                    >
                                </div>

                                <div class="form-group">
                                    <label for="order">Сортировка</label>
                                    <input type="number" name="order" class="form-control @error('order')is-invalid @enderror"
                                           id="order" placeholder="500" min="0" step="0"
                                           value="{{ $level->order }}"
                                    >
                                </div>
                            </div>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Сохранить</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
