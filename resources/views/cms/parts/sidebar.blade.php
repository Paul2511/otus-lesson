<nav class="sidebar">
    <div class="sidebar-header">
        <a href="#" class="sidebar-brand">@lang('cms-general.header')</a>
        <div class="sidebar-toggler not-active">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
    <div class="sidebar-body ps ps--active-y">
        <ul class="nav">
            <li class="nav-item nav-category">
                @lang('cms-general.main')
            </li>
            <li class="nav-item @if(\Request::route()->getName() === \App\Services\Routes\CMS\CMSRoutes::CMS_DASHBOARD_INDEX) active @endif">
                <a href="{{route(\App\Services\Routes\CMS\CMSRoutes::CMS_DASHBOARD_INDEX)}}" class="nav-link">
                    <i class="link-icon" data-feather="box"></i>
                    <span class="link-title">@lang('cms-general.dashboard')</span>
                </a>
            </li>
            <li class="nav-item nav-category">
                @lang('cms-general.settings')
            </li>
            <li class="nav-item @if(\Request::route()->getName() === \App\Services\Routes\CMS\CMSRoutes::CMS_USERS_INDEX) active @endif">
                <a href="{{route(\App\Services\Routes\CMS\CMSRoutes::CMS_USERS_INDEX)}}" class="nav-link">
                    <i class="link-icon" data-feather="users"></i>
                    <span class="link-title">@lang('cms-menu.users')</span>
                </a>
            </li>
            <li class="nav-item @if(\Request::route()->getName() === \App\Services\Routes\CMS\CMSRoutes::CMS_COUNTRIES_INDEX) active @endif">
                <a href="{{route(\App\Services\Routes\CMS\CMSRoutes::CMS_COUNTRIES_INDEX)}}" class="nav-link">
                    <i class="link-icon" data-feather="map"></i>
                    <span class="link-title">@lang('cms-menu.countries')</span>
                </a>
            </li>
        </ul>
    </div>
</nav>
