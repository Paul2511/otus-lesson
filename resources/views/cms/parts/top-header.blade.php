<nav class="navbar">
    <div class="navbar-content">
        @include('cms.forms.cms-search-top')
        <ul class="navbar-nav">
            <li class="nav-item dropdown">
                @include('cms.menus.menu-language')
            </li>
            <li class="nav-item dropdown nav-notifications">
                @include('cms.menus.menu-notification')
            </li>
            <li class="nav-item dropdown nav-profile">
                @include('cms.menus.menu-profile')
            </li>
        </ul>
    </div>
</nav>

