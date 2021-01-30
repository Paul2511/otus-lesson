@extends('admin.layouts.main')

@section('content')
    @php
        $title = 'Добавление';
        $breadcrumbs[] = ['url' => route('admin.index'), 'title' => 'Главная'];
        $breadcrumbs[] = ['url' => route('users.index'), 'title' => 'Пользователи'];
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
                            <form role="form" method="post" action="{{ route('users.store') }}">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name">Логин</label>
                                            <input type="text" name="name" class="form-control @error('name')is-invalid @enderror" id="name" placeholder="Логин">
                                        </div>

                                        <div class="form-group">
                                            <label for="password">Пароль</label>
                                            <input type="password" name="password" class="form-control @error('password')is-invalid @enderror" id="password">
                                        </div>

                                        <div class="form-group">
                                            <label for="password_confirmation ">Повторите пароль</label>
                                            <input type="password" name="password_confirmation" class="form-control @error('password_confirmation')is-invalid @enderror" id="password_confirmation ">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input type="email" name="email" class="form-control @error('email')is-invalid @enderror" id="email" placeholder="Email">
                                        </div>

                                        <div class="form-group">
                                            <label>Тип пользователя</label>

                                            @foreach($types as $val => $type)
                                            <div class="form-check">
                                                <input class="form-check-input @error('type')is-invalid @enderror" type="radio" name="type" value="{{$val}}" id="type_{{$val}}">
                                                <label class="form-check-label">{{ $type }}</label>
                                            </div>
                                            @endforeach
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
