<nav class="navbar fixed-top navbar-expand-lg navbar-dark scrolling-navbar">
    <div class="container">
        <a class="navbar-brand" href="https://mdbootstrap.com/docs/jquery/" target="_blank">
            <strong>MDB</strong>
        </a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="/">Главная</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('site.about') }}">О нас</a>
                </li>
            </ul>

            <ul class="navbar-nav nav-flex-icons">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('user.login') }}">Войти</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('user.signup') }}">Зарегистрироваться</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown"
                       aria-haspopup="true" aria-expanded="false">Пользователь</a>
                    <div class="dropdown-menu dropdown-primary" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="{{ route('user.profile') }}">Профиль</a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>
