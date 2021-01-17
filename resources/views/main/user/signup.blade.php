@extends('main/layout/auth')

@section('title')Регистрация@endsection

@section('content')
    <div class="col-md-6 col-xl-5 mb-4">
        <div class="card">
            <div class="card-body">
                <form>
                    <h3 class="dark-grey-text text-center">
                        <strong>Регистрация</strong>
                    </h3>

                    <hr>

                    <div class="md-form">
                        <i class="fas fa-user-cog prefix grey-text"></i>
                        <input type="text" id="first_name" class="form-control">
                        <label for="first_name">Имя</label>
                    </div>

                    <div class="md-form">
                        <i class="fas fa-user-cog prefix grey-text"></i>
                        <input type="text" id="last_name" class="form-control">
                        <label for="last_name">Фамилия</label>
                    </div>

                    <div class="md-form">
                        <i class="fas fa-user-cog prefix grey-text"></i>
                        <input type="email" id="email" class="form-control">
                        <label for="email">Email</label>
                    </div>

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
                        <button class="btn btn-indigo my-4">Присоединиться <i class="fas fa-user-plus"></i></button>

                        <p>Есть аккаунт?
                            <a href="{{ route('user.login') }}">Авторизоваться</a>
                        </p>
                    </div>

                    <hr>

                    <p class="text-center">Нажимая <em>"Присоединиться"</em> вы соглашаетесь с
                        <a href="{{ route('site.policy') }}" target="_blank">политикой конфиденциальности</a>
                    </p>
                </form>
            </div>
        </div>
    </div>
@endsection
