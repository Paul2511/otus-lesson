@extends('admin.layouts.main')

@section('content')
    @php
        $title = $groupSize->title;
        $breadcrumbs[] = ['url' => route('admin.index'), 'title' => 'Главная'];
        $breadcrumbs[] = ['url' => route('group-sizes.index'), 'title' => 'Размеры групп'];
        $breadcrumbs[] = ['url' => '#', 'title' => $title];
    @endphp
    @include('admin.blocks.breadcrumbs.index', ['breadcrumbs' => $breadcrumbs, $title])

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">{{ $groupSize->title }}</h3>
                        </div>

                        <form role="form" method="post" action="{{ route('group-sizes.update', ['group_size' => $groupSize->id]) }}">
                            @csrf
                            @method('PUT')

                            <div class="card-body">
                                <div class="form-group">
                                    <label for="title">Название</label>
                                    <input type="text" name="title" class="form-control @error('title')is-invalid @enderror"
                                           id="title"
                                           placeholder="Название"
                                           value="{{ $groupSize->title }}"
                                    >
                                </div>

                                <div class="form-group">
                                    <label for="max_count">Максимальное количество</label>
                                    <input type="number" name="max_count" class="form-control @error('max_count')is-invalid @enderror"
                                           id="max_count" placeholder="0" min="0" step="0"
                                           value="{{ $groupSize->max_count }}"
                                    >
                                </div>

                                <div class="form-group">
                                    <label for="order">Сортировка</label>
                                    <input type="number" name="order" class="form-control @error('order')is-invalid @enderror"
                                           id="order" placeholder="500" min="0" step="0"
                                           value="{{ $groupSize->order }}"
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
