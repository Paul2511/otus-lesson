<div class="collapse navbar-collapse" id="navbarNavAltMarkup">
    <div class="navbar-nav">
        <?php
        $menuLinks = [
            [
                'name' => __('main_menu.home'),
                'url' => '/'
            ],
            [
                'name' => __('main_menu.register'),
                'url' => '/register'
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
    </div>
</div>
