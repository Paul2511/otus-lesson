@extends('admin.layouts.main')

@section('content')
    @php
        $title = 'Уровни владения';
        $breadcrumbs[] = ['url' => route('admin.index'), 'title' => 'Главная'];
        $breadcrumbs[] = ['url' => '#', 'title' => $title];
    @endphp
    @include('admin.blocks.breadcrumbs.index', ['breadcrumbs' => $breadcrumbs, $title])

    <section class="content">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{$title}}</h3>

                {{ $levels->links('admin.blocks.pagination.default') }}

                <div class="card-tools pr-2">
                    <a href="{{ route('levels.create') }}" class="btn btn-tool btn-sm">
                        <i class="fas fa-plus"></i> Добавить уровнень
                    </a>
                </div>
            </div>
            <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                    <thead>
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>Название</th>
                            <th>Slug</th>
                            <th>Сортировка</th>
                            <th style="width: 40px"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($levels) > 0)
                            @foreach ($levels as $level)
                                <tr>
                                    <td>{{ $level->id }}</td>
                                    <td>{{ $level->title }}</td>
                                    <td>{{ $level->slug }}</td>
                                    <td>{{ $level->order }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{ route('levels.edit', ['level' => $level->id]) }}" type="button" class="btn btn-info">Редактировать</a>
                                            <form action="{{ route('levels.destroy', ['level' => $level->id]) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" type="button" class="btn btn-danger">Удалить</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="4" class="text-center">Нет навыков</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </section>
@endsection
