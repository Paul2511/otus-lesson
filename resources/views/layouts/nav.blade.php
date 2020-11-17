<div class="text-right top-line">
    <a class="orange" href="tel:{{ __('8-999-876-54-32') }}">&#9742; 8-999-876-54-32</a>
    <a class="top-register" href="{{ route('contacts') }}"> ул. Правды, д.1</a>
    <!-- Right Side Of Navbar -->
    @guest
        <span class="top-register"> | </span>
        <a class="top-register" href="{{ route('login') }}">{{ __('Вход') }}</a>
        @if (Route::has('register'))
            <a class="top-register" href="{{ route('register') }}">{{ __('Регистрация') }}</a>
        @endif
    @endguest
</div>
{{--------------logo-line-menu---------------}}
<nav class="navbar navbar-expand-md navbar-light navbar-laravel">
    <a class="navbar-brand site-logo" href="{{ url('/') }}">
        Sport<strong>Fit</strong>
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}"
            tabindex="1">
        <span class="icon-menu h1"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <!-- Left Side Of Navbar -->
        <ul class="navbar-nav mr-auto">
        </ul>
        <!-- Right Side Of Navbar -->
        <ul class="navbar-nav ml-auto">
            {{--------------about---------------}}
            <li class="nav-item dropdown">
                <a id="navbarDropdown " class="nav-link dropdown-toggle {{ Request::is('about*') ? 'active' : '' }}"
                   href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                   v-pre>Клуб<span class="caret"></span></a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{ route('about') }}">{{ __('О нас') }}</a>
                    <a class="dropdown-item" href="{{ route('photo') }}">{{ __('Фото галерея') }}</a>
                    <a class="dropdown-item" href="{{ route('actions') }}">{{ __('Акции') }}</a>
                    <a class="dropdown-item" href="{{ route('partners') }}">{{ __('Партнеры') }}</a>
                    <a class="dropdown-item" href="{{ route('comments') }}">{{ __('Отзывы') }}</a>
                </div>
            </li>
            {{--------------programs---------------}}
            <li class="nav-item dropdown">
                <a id="navbarDropdown " class="nav-link dropdown-toggle {{ Request::is('programs*') ? 'active' : '' }}"
                   href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>Программы<span
                        class="caret"></span></a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{ route('programs') }}">{{ __('Все программы') }}</a>
                    <a class="dropdown-item" href="{{ route('morning_programs') }}">{{ __('Утренние программы') }}</a>
                    <a class="dropdown-item" href="{{ route('body_building') }}">{{ __('Боди билдинг') }}</a>
                    <a class="dropdown-item" href="{{ route('stretching') }}">{{ __('Стретчинг') }}</a>
                    <a class="dropdown-item" href="{{ route('fitness') }}">{{ __('Фитнес') }}</a>
                    <a class="dropdown-item" href="{{ route('yoga') }}">{{ __('Йога') }}</a>
                    <a class="dropdown-item" href="{{ route('child_programs') }}">{{ __('Детские программы') }}</a>
                </div>
            </li>
            {{--------------cards---------------}}
            <li class="nav-item dropdown">
                <a id="navbarDropdown " class="nav-link dropdown-toggle {{ Request::is('cards*') ? 'active' : '' }}"
                   href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                   v-pre>Карты<span class="caret"></span></a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{ route('cards') }}">{{ __('Все карты') }}</a>
                    <a class="dropdown-item" href="{{ route('cards_year') }}">{{ __('Год') }}</a>
                    <a class="dropdown-item" href="{{ route('cards_six_month') }}">{{ __('6 месяцев') }}</a>
                    <a class="dropdown-item" href="{{ route('cards_three_month') }}">{{ __('3 месяца') }}</a>
                    <a class="dropdown-item" href="{{ route('cards_one_month') }}">{{ __('1 месяц') }}</a>
                    <a class="dropdown-item" href="{{ route('cards_personal') }}">{{ __('Персональные') }}</a>
                    <a class="dropdown-item" href="{{ route('cards_child') }}">{{ __('Детские') }}</a>
                </div>
            </li>
            {{--------------trainers---------------}}
            <li class="nav-item"><a class="nav-link {{ Request::is('trainers') ? 'active' : '' }}"
                                    href="{{ route('trainers') }}">{{ __('Тренеры') }}</a></li>
            {{--------------schedule---------------}}
            <li class="nav-item"><a class="nav-link {{ Request::is('schedule') ? 'active' : '' }}"
                                    href="{{ route('schedule') }}">{{ __('Расписание') }}</a></li>
            {{--------------contacts---------------}}
            <li class="nav-item"><a class="nav-link {{ Request::is('contacts') ? 'active' : '' }}"
                                    href="{{ route('contacts') }}">{{ __('Контакты') }}</a></li>
            {{----------privacy-------------------}}
            {{--------------privacy-admin---------}}
            @admin
            <li class="nav-item dropdown">
                <a id="navbarDropdown " class="nav-link dropdown-toggle {{ Request::is('privacy*') ? 'active' : '' }}"
                   href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    <img id="img_photo" src="{{ asset("{$avatar_url}") }}" alt="Image"
                         class="img-fluid rounded-circle avatar-nav img-thumbnail">
                    {{ Auth::user()->name }} (Админ)
                    <span class="caret"></span></a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item {{ Request::is('*privacy/profile*') ? 'active' : '' }}"
                       href="{{ route('privacy.profile') }}">{{ __('Мой профиль') }}</a>

                    <a class="dropdown-item {{ Request::is('*privacy/admin/users*') ? 'active' : '' }}"
                       href="{{ route('privacy.admin.users') }}">{{ __('Пользователи') }}</a>

                    <a class="dropdown-item {{ Request::is('*privacy/admin/schedules*') ? 'active' : '' }}"
                       href="{{ route('privacy.admin.schedules') }}">{{ __('Расписание') }}</a>

                    <a class="dropdown-item {{ Request::is('*privacy/admin/cards*') ? 'active' : '' }}"
                       href="{{ route('privacy.admin.cards') }}">{{ __('Карты') }}</a>

                    <a class="dropdown-item {{ Request::is('*privacy/admin/comments*') ? 'active' : '' }}"
                       href="{{ route('privacy.admin.comments') }}">{{ __('Отзывы') }}</a>

                    <a class="dropdown-item {{ Request::is('*privacy/admin/faq*') ? 'active' : '' }}"
                       href="{{ route('privacy.admin.faq') }}">{{ __('Обратная связь') }}</a>

                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">{{ __('Выход') }}</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </li>
            @endadmin
            {{--------------privacy-guest-auth---------------}}
            @guestCheckAuth
            <li class="nav-item dropdown">
                <a id="navbarDropdown " class="nav-link dropdown-toggle {{ Request::is('privacy*') ? 'active' : '' }}"
                   href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    <img id="img_photo" src="{{ asset("{$avatar_url}") }}" alt="Image"
                         class="img-fluid rounded-circle avatar-nav img-thumbnail">
                    {{ Auth::user()->name }}
                    <span class="caret"></span></a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item {{ Request::is('*privacy/profile*') ? 'active' : '' }}"
                       href="{{ route('privacy.profile') }}">{{ __('Мой профиль') }}</a>

                    <a class="dropdown-item {{ Request::is('*privacy/schedules*') ? 'active' : '' }}"
                       href="{{ route('privacy.schedules') }}">{{ __('Мои тренировки') }}</a>

                    <a class="dropdown-item {{ Request::is('*privacy/cards*') ? 'active' : '' }}"
                       href="{{ route('privacy.cards') }}">{{ __('Мои карты') }}</a>

                    <a class="dropdown-item {{ Request::is('*privacy/comments*') ? 'active' : '' }}"
                       href="{{ route('privacy.comments') }}">{{ __('Мои отзывы') }}</a>

                    <a class="dropdown-item {{ Request::is('*privacy/faq*') ? 'active' : '' }}"
                       href="{{ route('privacy.faq') }}">{{ __('Обратная связь') }}</a>

                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">{{ __('Выход') }}</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </li>
            @endguestCheckAuth
            {{--------------privacy-trainer--------------}}
            @trainer
            <li class="nav-item dropdown">
                <a id="navbarDropdown " class="nav-link dropdown-toggle {{ Request::is('privacy*') ? 'active' : '' }}"
                   href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    <img id="img_photo" src="{{ asset("{$avatar_url}") }}" alt="Image"
                         class="img-fluid rounded-circle avatar-nav img-thumbnail">
                    {{ Auth::user()->name }} (Тренер)
                    <span class="caret"></span></a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                    <a class="dropdown-item {{ Request::is('*privacy/profile*') ? 'active' : '' }}"
                       href="{{ route('privacy.profile') }}">{{ __('Мой профиль') }}</a>

                    <a class="dropdown-item {{ Request::is('*privacy/schedules*') ? 'active' : '' }}"
                       href="{{ route('privacy.schedules') }}">{{ __('Мои тренировки') }}</a>


                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">{{ __('Выход') }}</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </li>
            @endtrainer
            {{--------------privacy-support--------------}}
            @support
            <li class="nav-item dropdown">
                <a id="navbarDropdown " class="nav-link dropdown-toggle {{ Request::is('privacy*') ? 'active' : '' }}"
                   href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    <img id="img_photo" src="{{ asset("{$avatar_url}") }}" alt="Image"
                         class="img-fluid rounded-circle avatar-nav img-thumbnail">
                    {{ Auth::user()->name }} (Support)
                    <span class="caret"></span></a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                    <a class="dropdown-item {{ Request::is('*privacy/profile*') ? 'active' : '' }}"
                       href="{{ route('privacy.profile') }}">{{ __('Мой профиль') }}</a>

                    <a class="dropdown-item {{ Request::is('*privacy/faq*') ? 'active' : '' }}"
                       href="{{ route('privacy.faq') }}">{{ __('Обратная связь') }}</a>


                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">{{ __('Выход') }}</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </li>
            @endsupport
            {{--------------privacy-content--------------}}
            @content
            <li class="nav-item dropdown">
                <a id="navbarDropdown " class="nav-link dropdown-toggle {{ Request::is('privacy*') ? 'active' : '' }}"
                   href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    <img id="img_photo" src="{{ asset("{$avatar_url}") }}" alt="Image"
                         class="img-fluid rounded-circle avatar-nav img-thumbnail">
                    {{ Auth::user()->name }} (Менеджер)
                    <span class="caret"></span></a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                    <a class="dropdown-item {{ Request::is('*privacy/profile*') ? 'active' : '' }}"
                       href="{{ route('privacy.profile') }}">{{ __('Мой профиль') }}</a>

                    <a class="dropdown-item {{ Request::is('*privacy/comments*') ? 'active' : '' }}"
                       href="{{ route('privacy.comments') }}">{{ __('Мои отзывы') }}</a>

                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">{{ __('Выход') }}</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </li>
            @endcontent
        </ul>
    </div>
</nav>
