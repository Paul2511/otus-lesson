@extends('admin.layouts.main')

@section('content')
    @php
        $title = 'Размеры групп';
        $breadcrumbs[] = ['url' => route('admin.index'), 'title' => 'Главная'];
        $breadcrumbs[] = ['url' => '#', 'title' => $title];
    @endphp
    @include('admin.blocks.breadcrumbs.index', ['breadcrumbs' => $breadcrumbs, $title])

    <section class="content">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{$title}}</h3>

                {{ $groupSizes->links('admin.blocks.pagination.default') }}

                <div class="card-tools pr-2">
                    <a href="{{ route('group-sizes.create') }}" class="btn btn-tool btn-sm">
                        <i class="fas fa-plus"></i> Добавить размер
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
                            <th>Макс. кол-во</th>
                            <th>Сортировка</th>
                            <th style="width: 40px"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($groupSizes) > 0)
                            @foreach ($groupSizes as $groupSize)
                                <tr>
                                    <td>{{ $groupSize->id }}</td>
                                    <td>{{ $groupSize->title }}</td>
                                    <td>{{ $groupSize->slug }}</td>
                                    <td>{{ $groupSize->max_count }}</td>
                                    <td>{{ $groupSize->order }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{ route('group-sizes.edit', ['group_size' => $groupSize->id]) }}" type="button" class="btn btn-info">Редактировать</a>
                                            <form action="{{ route('group-sizes.destroy', ['group_size' => $groupSize->id]) }}" method="post">
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
