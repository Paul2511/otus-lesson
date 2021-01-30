@extends('admin.layouts.main')

@section('content')
    @php
        $title = 'Добавление навыка' ;
        $breadcrumbs[] = ['url' => route('admin.index'), 'title' => 'Главная'];
        $breadcrumbs[] = ['url' => route('users.index'), 'title' => 'Пользователи'];
        $breadcrumbs[] = ['url' => route('users.show', ['user' => $user->id]), 'title' => $user->name];
        $breadcrumbs[] = ['url' => '#', 'title' => $title];
    @endphp
    @include('admin.blocks.breadcrumbs.index', ['breadcrumbs' => $breadcrumbs, $title])

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">{{ $title }}</h3>
                        </div>

                        <div class="card-body">
                            <form role="form" method="post" action="{{ route('users.skills.store', ['user' => $user->id]) }}">
                                @csrf

                                <input type="hidden" name="user_id" value="{{ $user->id }}">

                                <div class="form-group">
                                    <label for="skill_id">Навык</label>
                                    <select class="form-control" name="skill_id"  id="skill_id">
                                        <option>Нет навыка</option>
                                        @foreach($skills as $k => $v)
                                            <option value="{{ $k }}">{{ $v }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="level_id">Уровень владения</label>
                                    <select class="form-control" name="level_id"  id="level_id">
                                        <option>Нет уровня</option>
                                        @foreach($levels as $k => $v)
                                            <option value="{{ $k }}">{{ $v }}</option>
                                        @endforeach
                                    </select>
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
