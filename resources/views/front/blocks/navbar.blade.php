<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item"><a class="nav-link" href="/">@lang('navs.home')</a></li>
            <li class="nav-item"><a class="nav-link" href="/adv">@lang('navs.adv')</a></li>
            <li class="nav-item"><a class="nav-link" href="/news">@lang('navs.news')</a></li>
            <li class="nav-item"><a class="nav-link" href="/about">@lang('navs.about')</a></li>
            @if ( !Auth::guest() )
                <li class="nav-item"><a class="nav-link" href="/lk">@lang('navs.lk')</a></li>
            @endif
        </ul>
        <ul class="nav navbar-nav navbar-right">
            @if ( Auth::guest() )
                <a class="btn btn-default navbar-btn nav-link" href="/login"><span class="glyphicon glyphicon-log-in"></span> @lang('navs.login')</a>
                <a class="btn btn-success navbar-btn" href="/register"><span class="glyphicon glyphicon-heart"></span> @lang('navs.register')</a>
            @else
                @lang('messages.welcome'), <strong>{{ Auth::user()->username }} </strong> |
                <a href="/logout">@lang('navs.logout')</a>
            @endif
        </ul>
    </div>
</nav>
