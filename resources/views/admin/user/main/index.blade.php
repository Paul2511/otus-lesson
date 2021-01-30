@extends('admin.layouts.main')

@section('content')
    @php
        $title = 'Пользователи';
        $breadcrumbs[] = ['url' => route('admin.index'), 'title' => 'Главная'];
        $breadcrumbs[] = ['url' => '#', 'title' => $title];
    @endphp
    @include('admin.blocks.breadcrumbs.index', ['breadcrumbs' => $breadcrumbs, $title])

    <section class="content">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{$title}}</h3>

                {{ $users->links('admin.blocks.pagination.default') }}

                <div class="card-tools pr-2">
                    <a href="{{ route('users.create') }}" class="btn btn-tool btn-sm">
                        <i class="fas fa-plus"></i> Добавить пользователя
                    </a>
                </div>
            </div>
            <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                    <thead>
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>Логин</th>
                            <th>Email</th>
                            <th>Тип</th>
                            <th style="width: 40px"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($users) > 0)
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->types()[$user->type] }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{ route('users.edit', ['user' => $user->id]) }}" type="button" class="btn btn-info">Редактировать</a>
                                            <a href="{{ route('users.show', ['user' => $user->id]) }}" type="button" class="btn btn-success">Профиль</a>
                                            <form action="{{ route('users.destroy', ['user' => $user->id]) }}" method="post">
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
