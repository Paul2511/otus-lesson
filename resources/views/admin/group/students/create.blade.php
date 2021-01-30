@extends('admin.layouts.main')

@section('content')
    @php
        $title = 'Добавление';
        $breadcrumbs[] = ['url' => route('admin.index'), 'title' => 'Главная'];
        $breadcrumbs[] = ['url' => route('groups.index'), 'title' => 'Группы'];
        $breadcrumbs[] = ['url' => route('groups.show', ['group' => $group->id]), 'title' => $group->title];
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
                            <form role="form" method="post" action="{{ route('groups.students.store', ['group' => $group->id]) }}">
                                @csrf

                                <input type="hidden" name="group_id" value="{{ $group->id }}">

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="student_id">Студент</label>
                                            <select class="form-control @error('student_id')is-invalid @enderror" name="student_id"  id="student_id">
                                                <option>Не указан</option>
                                                @foreach($users as $k => $v)
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
