<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">@lang('views.navbar_label')</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="@lang('views.navbar_toggle')">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            @section('nav')
                <li class="nav-item{{ (Request::getRequestUri() == '/'.app()->getLocale())?' active':''  }}">
                    <a href="/{{ app()->getLocale() }}" class="nav-link">@lang('views.home_link')</a>
                </li>
                @auth
                    <li class="nav-item{{ (Request::getRequestUri() == '/'.app()->getLocale().'/logout')?' active':''  }}">
                        <a href="/{{ app()->getLocale() }}/logout" class="nav-link">@lang('views.logout_link')</a>
                    </li>
                @else
                    <li class="nav-item{{ (Request::getRequestUri() == '/'.app()->getLocale().'/login')?' active':''  }}">
                        <a href="/{{ app()->getLocale() }}/login" class="nav-link">@lang('views.login_link')</a>
                    </li>
                    <li class="nav-item{{ (Request::getRequestUri() == '/'.app()->getLocale().'/register')?' active':''  }}">
                        <a href="/{{ app()->getLocale() }}/register" class="nav-link">@lang('views.register_link')</a>
                    </li>
                @endif
                <li class="nav-item{{ (Request::getRequestUri() == '/'.app()->getLocale().'/contacts')?' active':''  }}">
                    <a href="/{{ app()->getLocale() }}/contacts" class="nav-link">@lang('views.contacts_link')</a>
                </li>
            @show

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    @lang('views.language_selector') - {{ strtoupper(app()->getLocale()) }}
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    @foreach (config('app.available_locales') as $locale)
                        <a class="dropdown-item" href="{{ str_replace('/'.app()->getLocale(),'/'.$locale, Request::getRequestUri()) }}" @if (app()->getLocale() == $locale) style="font-weight: bold; text-decoration: underline" @endif>{{ strtoupper($locale) }}</a>
                    @endforeach
                </div>
            </li>
        </ul>
        <form class="form-inline my-2 my-lg-0" action="/{{ app()->getLocale() }}/search" method="get">
            <input name="q" class="form-control mr-sm-2" type="search" placeholder="@lang('views.search_label')" aria-label="@lang('views.search_label')">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">@lang('views.search_label')</button>
        </form>
    </div>
</nav>
