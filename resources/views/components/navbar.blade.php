<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="{{ PublicRoutes::home() }}">
            {{ config('app.name', 'Laravel') }}
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="@lang('Toggle navigation')">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">

            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">

                <!-- Authentication Links -->
                @guest
                    @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">
                                @lang('messages.login')
                            </a>
                        </li>
                    @endif

                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">
                                @lang('messages.register')
                            </a>
                        </li>
                    @endif

                    <li class="nav-item">
                        <a class="nav-link" href="{{ PublicRoutes::contacts() }}">
                            @lang('messages.contact_us')
                        </a>
                    </li>
                @else
                    @if(Auth::user()->can(Permission::VIEW_ANY, \App\Models\Survey::class))
                        <li class="mav-item">
                            <a class="nav-link" href="{{ route(AdminRoutes::SURVEYS_INDEX) }}">
                                @lang('messages.admin_panel')
                            </a>
                        </li>
                    @endif

                    <li class="nav-item dropdown">
                        <a id="navbarDropdown"
                           class="nav-link dropdown-toggle"
                           href="#"
                           role="button"
                           data-toggle="dropdown"
                           aria-haspopup="true"
                           aria-expanded="false"
                           v-pre
                        >
                            {{ Auth::user()->name }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                @lang('Logout')
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                    <li class="nav-item">
                        <span class="nav-link">
                            @lang('user.role'):
                            @lang('user.role_' . Auth::user()->role)
                        </span>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
