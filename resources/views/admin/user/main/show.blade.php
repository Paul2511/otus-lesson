@extends('admin.layouts.main')

@section('content')
    @php
        $title = 'Пользователь: ' . $user->id;
        $breadcrumbs[] = ['url' => route('admin.index'), 'title' => 'Главная'];
        $breadcrumbs[] = ['url' => route('users.index'), 'title' => 'Пользователи'];
        $breadcrumbs[] = ['url' => '#', 'title' => $title];
    @endphp
    @include('admin.blocks.breadcrumbs.index', ['breadcrumbs' => $breadcrumbs, $title])

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <img class="profile-user-img img-fluid img-circle"
                                     src="https://randomuser.me/api/portraits/men/{{ rand(1,100) }}.jpg"
                                     alt="пользователь {{$user->name}}">
                            </div>

                            <h3 class="profile-username text-center">{{$user->name}}</h3>

                            <p class="text-muted text-center">{{$user->types()[$user->type]}}</p>

                            <a href="{{ route('users.edit', ['user' => $user->id]) }}" class="btn btn-primary btn-block"><b>Редактировать</b></a>
                        </div>
                    </div>
                </div>

                <div class="col-md-9">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Навыки</h3>

                            <div class="card-tools pr-2">
                                <a href="{{  route('users.skills.create', ['user' => $user->id]) }}" class="btn btn-tool btn-sm">
                                    <i class="fas fa-plus"></i> Добавить навык
                                </a>
                            </div>
                        </div>

                        <div class="card-body table-responsive p-0">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>Навык</th>
                                    <th>Уровень</th>
                                    <th style="width: 40px"></th>
                                </tr>
                                </thead>
                                <tbody>
                                @if (count($skills) > 0)
                                    @foreach ($skills as $skill)
                                        <tr>
                                            <td>{{ $skill->skill->title }}</td>
                                            <td>{{ $skill->level->title }}</td>
                                            <td>
                                                <div class="btn-group">
                                                    <form action="{{ route('users.skills.destroy', ['user' => $skill->user_id, 'skill' => $skill->id]) }}" method="post">
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
                </div>
            </div>
        </div>
    </section>
@endsection
