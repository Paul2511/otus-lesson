@extends('admin.layouts.main')

@section('content')
    @php
        $title = 'Редактирование: ' . $user->name;
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
                            <form role="form" method="post" action="{{ route('users.update', ['user' => $user->id]) }}">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name">Логин</label>
                                            <input
                                                id="name" class="form-control @error('name')is-invalid @enderror"
                                                type="text" name="name"
                                                placeholder="Логин"
                                                value="{{ old('name') ?? $user->name }}"
                                            >
                                        </div>

                                        <div class="form-group">
                                            <label for="password">Пароль</label>
                                            <input
                                                id="password" class="form-control @error('password')is-invalid @enderror"
                                                type="password" name="password"
                                                value="{{ old('password') ?? '' }}"
                                            >
                                        </div>

                                        <div class="form-group">
                                            <label for="password_confirmation ">Повторите пароль</label>
                                            <input
                                                id="password_confirmation" class="form-control @error('password_confirmation')is-invalid @enderror"
                                                type="password" name="password_confirmation"
                                                value="{{ old('password_confirmation') ?? '' }}"
                                            >
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input
                                                id="email" class="form-control @error('email')is-invalid @enderror"
                                                type="email" name="email"
                                                placeholder="Email"
                                                value="{{ old('email') ?? $user->email }}"
                                            >
                                        </div>

                                        <div class="form-group">
                                            <label for="type">Тип пользователя</label>

                                            @foreach($types as $val => $type)
                                                <div class="form-check">
                                                    <input
                                                        id="type_{{$val}}" class="form-check-input @error('type')is-invalid @enderror"
                                                        type="radio" name="type"
                                                        value="{{ $val }}"
                                                        @if($user->type == $val) checked @endif
                                                    >
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
