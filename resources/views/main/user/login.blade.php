@extends('main/layout/auth')

@section('title')Авторизация@endsection

@section('content')
    <div class="col-md-6 col-xl-5 mb-4">
        <div class="card">
            <div class="card-body">
                <form>
                    <h3 class="dark-grey-text text-center">
                        <strong>Авторизация</strong>
                    </h3>
                    <hr>

                    <div class="md-form">
                        <i class="fas fa-user prefix grey-text"></i>
                        <input type="text" id="login" class="form-control">
                        <label for="login">Логин</label>
                    </div>

                    <div class="md-form">
                        <i class="fas fa-key prefix grey-text"></i>
                        <input type="password" id="password" class="form-control">
                        <label for="password">Пароль</label>
                    </div>

                    <div class="text-center">
                        <button class="btn btn-indigo">Войти <i class="fas fa-sign-in-alt"></i></button>

                        <p>Ещё нет аккаунта?
                            <a href="{{ route('user.signup') }}">Зарегистрироваться</a>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
