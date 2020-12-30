<div class="nav-item"><a href="/">Главная</a></div>
@if(!Auth::check())
<div class="nav-item"><a href="{{route('user.create')}}">Регистрация</a></div>
@endif
@if(Auth::check())
<div class="nav-item"><a href="{{route('user.show', ['user' => Auth::id()])}}">Личный кабинет</a></div>
@endif
<div class="nav-item"><a href="/contacts">Контакты</a></div>
@if(!Auth::check())
<div class="nav-item"><a href="{{route('user.login')}}">Login</a></div>
@else
<div class="nav-item"><a href="{{route('user.logout')}}">Logout</a></div>
@endif