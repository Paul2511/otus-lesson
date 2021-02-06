<div class="collapse navbar-collapse" id="navbarNavAltMarkup">
    <div class="navbar-nav">
        <?php
        $menuLinks = [
            [
                'name' => __('main_menu.home'),
                'url' => '/'
            ],
            [
                'name' => __('main_menu.profile'),
                'url' => '/profile'
            ],
            [
                'name' => __('main_menu.about'),
                'url' => '/about'
            ]
        ];
        ?>

        @foreach($menuLinks as $menuLink)
            <a class="nav-item nav-link" href="{{ $menuLink['url'] }}">{{ $menuLink['name'] }}</a>
        @endforeach
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                    @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                    @endif

                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('register.title') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
    </div>
</div>
