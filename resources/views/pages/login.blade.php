@extends("layouts.app")

@section("content")
    <div class="home-banner bg-primary py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-12 col-content">
                    <p class="h1">@lang("Войдите в аккаунт")</p>
                    <div class="home-banner__content mt-4">
                        <p>@lang("Чтобы получить активировать все возможности сервиса, необходимо авторизироваться в системе")</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="py-5">
        <div class="container">
            <div class="row">

                <div class="col-md-7 col-lg-6 col-12">
                    <form>
                        <div class="form-group">
                            <label for="loginInputEmail">@lang("Введите e-mail")</label>
                            <input type="email"
                                   class="form-control"
                                   id="loginInputEmail"
                                   aria-describedby="emailHelp">

                            <small id="emailHelp" class="form-text text-muted">
                                @lang("Мы никогда никому не передадим вашу электронную почту.")
                            </small>
                        </div>

                        <div class="form-group">
                            <label for="loginInputPassword">@lang("Введите пароль")</label>
                            <input type="password" class="form-control" id="loginInputPassword">
                        </div>

                        <div class="form-group form-check">
                            <input type="checkbox" class="form-check-input" id="loginCheckmark">
                            <label class="form-check-label" for="loginCheckmark">@lang("Запомнить меня")</label>
                        </div>
                        <button type="submit" class="btn btn-lg px-5 btn-primary">@lang("Войти")</button>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection
