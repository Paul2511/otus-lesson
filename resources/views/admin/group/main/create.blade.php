@extends('admin.layouts.main')

@section('content')
    @php
        $title = 'Добавление';
        $breadcrumbs[] = ['url' => route('admin.index'), 'title' => 'Главная'];
        $breadcrumbs[] = ['url' => route('groups.index'), 'title' => 'Группы'];
        $breadcrumbs[] = ['url' => '#', 'title' => $title];
    @endphp
    @include('admin.blocks.breadcrumbs.index', ['breadcrumbs' => $breadcrumbs, $title])

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">{{ $title }}</h3>
                        </div>
                        <div class="card-body">
                            <form role="form" method="post" action="{{ route('groups.store') }}">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="title">Название</label>
                                            <input type="text" name="title" class="form-control @error('title')is-invalid @enderror" id="title" placeholder="Название">
                                        </div>

                                        <div class="form-group">
                                            <label for="description">Описание</label>
                                            <textarea name="description" class="form-control @error('description')is-invalid @enderror" id="description" rows="7" placeholder="Описание"></textarea>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="is_active">Активность</label>
                                            <div class="form-check">
                                                <input class="form-check-input @error('is_active')is-invalid @enderror" type="radio" name="is_active" value="1">
                                                <label class="form-check-label">Активная</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input @error('is_active')is-invalid @enderror" type="radio" name="is_active" value="0">
                                                <label class="form-check-label">Неактиная</label>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="size_id">Размер</label>
                                            <select class="form-control @error('size_id')is-invalid @enderror" name="size_id"  id="size_id">
                                                <option>Не указан</option>
                                                @foreach($sizes as $k => $v)
                                                    <option value="{{ $k }}">{{ $v }}</option>
                                                @endforeach
                                            </select>
                                        </div>
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
        </div>
    </section>
@endsection
