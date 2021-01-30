@extends('admin.layouts.main')

@section('content')
    @php
        $title = 'Группа: ' . $group->id;
        $breadcrumbs[] = ['url' => route('admin.index'), 'title' => 'Главная'];
        $breadcrumbs[] = ['url' => route('groups.index'), 'title' => 'Группы'];
        $breadcrumbs[] = ['url' => '#', 'title' => $title];
    @endphp
    @include('admin.blocks.breadcrumbs.index', ['breadcrumbs' => $breadcrumbs, $title])

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <h3 class="profile-username text-center">{{$group->name}}</h3>

                            <p class="text-muted text-center">{{$group->description}}</p>

                            <p class="text-muted text-center">{{$group->size->title}} ({{$group->size->max_count}} чел.)</p>

                            <a href="{{ route('groups.edit', ['group' => $group->id]) }}" class="btn btn-primary btn-block"><b>Редактировать</b></a>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <h3 class="col-12">Студенты</h3>
                    @if($group->students->count() < $group->size->max_count)

                        <a href="{{ route('groups.students.create', ['group' => $group->id]) }}" class="btn btn-primary mb-3">Добавить студента</a>
                    @endif

                    @include('admin.group.main.blocks.user.list', ['group' => $group, 'users' => $group->students, 'destroy' => 'groups.students.destroy', 'param' => 'student'])
                </div>

                <div class="col-md-12">
                    <h3 class="col-12">Преподаватели</h3>

                    <a href="{{ route('groups.teachers.create', ['group' => $group->id]) }}" class="btn btn-primary mb-3">Добавить преподавателя</a>

                    @include('admin.group.main.blocks.user.list', ['group' => $group, 'users' => $group->teachers, 'destroy' => 'groups.teachers.destroy', 'param' => 'teacher'])
                </div>
            </div>
        </div>
    </section>
@endsection
