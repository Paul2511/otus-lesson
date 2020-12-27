<ul class="nav navbar navbar-right justify-content-end">
    <li class="nav-item">
        <a class="nav-link" href="{{route('profile')}}" class="hidden-xs"><i
                class="ion ion-ios-locked-outline"></i>@lang('base.profile')</a>
    </li>
    <li>/</li>
    <li class="nav-item">

            <form id="logout-form" action="{{ route('logout') }}" method="post" >
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <button class="hidden-xs register-links">@lang('base.logout')</button>
            </form>

    </li>
</ul>
