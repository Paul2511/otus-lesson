@extends("layouts.app")

@section("content")
    <div class="home-banner bg-primary py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-12 col-content">
                    <p class="h1">@lang("Зарегистрируйтесь")</p>
                    <div class="home-banner__content mt-4">
                        <p>
                            @lang("Станьте полноправным пользователем и откройте доступ ко всем возможностям сервиса. Успейте, пока это бесплатно!")
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="py-5 d-flex flex-column flex-grow-1">
        <div class="container">
            <div class="row">

                <div class="col-md-7 col-lg-6 col-12">
                    <form>
                        <div class="form-group">
                            <label for="loginInputName">@lang("Ваше имя")</label>
                            <input type="text"
                                   class="form-control"
                                   id="loginInputName"
                            >
                        </div>

                        <div class="form-group">
                            <label for="loginInputEmail">@lang("Ваш e-mail")</label>
                            <input type="email"
                                   class="form-control"
                                   id="loginInputEmail"
                                   aria-describedby="emailHelp">

                            <small id="emailHelp" class="form-text text-muted">
                                @lang("Мы никогда никому не передадим вашу электронную почту.")
                            </small>
                        </div>

                        <div class="form-group">
                            <label for="loginInputPassword">@lang("Пароль")</label>
                            <input type="password" class="form-control" id="loginInputPassword">
                        </div>

                        <div class="form-group">
                            <label for="loginInputPassword2">@lang("Подтверждение пароля")</label>
                            <input type="password" class="form-control" id="loginInputPassword2">
                        </div>

                        <button type="submit" class="btn mt-3 py-2 px-4 btn-primary">@lang("Зарегистрироваться")</button>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection
