@extends('admin.layouts.main')

@section('content')
    @php
        $title = 'Группы';
        $breadcrumbs[] = ['url' => route('admin.index'), 'title' => 'Главная'];
        $breadcrumbs[] = ['url' => '#', 'title' => $title];
    @endphp
    @include('admin.blocks.breadcrumbs.index', ['breadcrumbs' => $breadcrumbs, $title])

    <section class="content">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{$title}}</h3>

                {{ $groups->links('admin.blocks.pagination.default') }}

                <div class="card-tools pr-2">
                    <a href="{{ route('groups.create') }}" class="btn btn-tool btn-sm">
                        <i class="fas fa-plus"></i> Добавить группу
                    </a>
                </div>
            </div>
            <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                    <thead>
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>Название</th>
                            <th>Активность</th>
                            <th>Размер</th>
                            <th style="width: 40px"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($groups) > 0)
                            @foreach ($groups as $group)
                                <tr>
                                    <td>{{ $group->id }}</td>
                                    <td>{{ $group->title }}</td>
                                    <td>{{ $group->is_active }}</td>
                                    <td>{{ $group->size->title }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{ route('groups.edit', ['group' => $group->id]) }}" type="button" class="btn btn-info">Редактировать</a>
                                            <a href="{{ route('groups.show', ['group' => $group->id]) }}" type="button" class="btn btn-success">Профиль</a>
                                            <form action="{{ route('groups.destroy', ['group' => $group->id]) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Удалить</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="4" class="text-center">Нет пользователей</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </section>
@endsection
