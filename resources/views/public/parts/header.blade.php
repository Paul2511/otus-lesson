<header>
    <div class="top-bar">
        <div class="container">
            <div class="row  align-items-center">
                <div class="top-bar-nav-search" id="lenght-block-left">
                    <ul class="nav navbar social-links justify-content-start">
                        <li>
                            <a href="https://www.facebook.com/eBusinessData/" target="_blank">
                                <svg class="mt-1 mr-3" width="17" height="17">
                                    <use xlink:href="#facebook"></use>
                                </svg>
                            </a>
                        </li>
                        <li>
                            <a href="https://twitter.com/eBusinessData" target="_blank">
                                <svg class="mt-1 mr-3" width="17" height="17">
                                    <use xlink:href="#twitter"></use>
                                </svg>
                            </a>
                        </li>
                        <li><a href="/rss">
                                <svg class="mt-1 mr-3" width="17" height="17">
                                    <use xlink:href="#rss"></use>
                                </svg>
                            </a></li>
                    </ul>
                </div>
                <div class="lng ml-auto">
                    <ul class="nav">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarLng" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{mb_strtoupper(app()->getLocale())}}
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarLng">
                                @foreach(config('app.locales') as $locale)
                                    @continue( $locale==app()->getLocale())
                                    <a class="dropdown-item" href="#">@lang('language.'.$locale)</a>
                                @endforeach
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="top-bar-user" id="lenght-block-right">
                    @auth()
                        @include('public.parts.menu.user-top-meniu')
                    @else
                        @include('public.parts.menu.guest-top-menu')
                    @endif
                </div>

            </div>
        </div>
    </div>
    <div class="header">
        <div class="container pt-2 ">
            <div class="row justify-content-between">
                <div class="logo">
                    <img src="/images/edata-logo.svg" alt="logo">
                </div>
                <div class="">
                    <ul class="navbar nav mr-auto justify-content-end">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarAbout" role="button"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                @lang('menu.about')
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarAbout">
                                <a class="dropdown-item" href="#">@lang('menu.about')</a>
                                <a class="dropdown-item" href="#">@lang('menu.open_data')</a>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">@lang('menu.news')</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">@lang('menu.price')</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">@lang('menu.last_company')</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarQualifier" role="button"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                @lang('menu.qualifier')
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="#">@lang('menu.unlicensed_activities_v1')</a>
                                <a class="dropdown-item" href="#">@lang('menu.unlicensed_activities_v2')</a>
                                <a class="dropdown-item" href="#">@lang('menu.licensed_activities')</a>
                                <a class="dropdown-item" href="#">@lang('menu.cvp_codes')</a>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">@lang('menu.faq')</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="tagline">
                @lang('base.tagline')
            </div>
        </div>
    </div>
</header>
