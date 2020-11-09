<div class="header-top">
    <div class="container">
        <div class="row">
            <div class="col-lg-2">
                <div class="logo-area">
                    <a href="{{route('page.main')}}">
                        @include('blocks.logo.index')
                    </a>
                </div>
            </div>
            <div class="col-lg-10">
                <div class="custom-navbar">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
                <div class="main-menu">
                    <ul>
                        <li class="active"><a href="{{route('page.main')}}">Главная</a></li>
                        <li><a href="{{route('page.about')}}">О нас</a></li>
                        <li><a href="{{route('page.profile')}}">Мой профиль</a></li>
                        <li class="menu-btn">
                            <a href="#" class="login">Войти</a>
                            <a href="{{route('register')}}" class="template-btn">Зарегистрироваться</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
