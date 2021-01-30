@extends('admin.layouts.main')

@section('content')
    @php
        $title = 'Навыки';
        $breadcrumbs[] = ['url' => route('admin.index'), 'title' => 'Главная'];
        $breadcrumbs[] = ['url' => '#', 'title' => $title];
    @endphp
    @include('admin.blocks.breadcrumbs.index', ['breadcrumbs' => $breadcrumbs, $title])

    <section class="content">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{$title}}</h3>

                {{ $skills->links('admin.blocks.pagination.default') }}

                <div class="card-tools pr-2">
                    <a href="{{ route('skills.create') }}" class="btn btn-tool btn-sm">
                        <i class="fas fa-plus"></i> Добавить навык
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
                            <th style="width: 40px"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($skills) > 0)
                            @foreach ($skills as $skill)
                                <tr>
                                    <td>{{ $skill->id }}</td>
                                    <td>{{ $skill->title }}</td>
                                    <td>{{ $skill->slug }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{ route('skills.edit', ['skill' => $skill->id]) }}" type="button" class="btn btn-info">Редактировать</a>
                                            <form action="{{ route('skills.destroy', ['skill' => $skill->id]) }}" method="post">
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
