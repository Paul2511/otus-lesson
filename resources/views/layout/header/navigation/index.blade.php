<div class="collapse navbar-collapse" id="navbarNavAltMarkup">
    <div class="navbar-nav">
        <?php
        $menuLinks = [
            [
                'name' => __('top_menu.home'),
                'url' => '/'
            ],
            [
                'name' => __('top_menu.register'),
                'url' => '/register'
            ],
            [
                'name' => __('top_menu.profile'),
                'url' => '/profile'
            ],
            [
                'name' => __('top_menu.about'),
                'url' => '/about'
            ]
        ];
        ?>

        @foreach($menuLinks as $menuLink)
            <a class="nav-item nav-link" href="{{ $menuLink['url'] }}">{{ $menuLink['name'] }}</a>
        @endforeach
    </div>
</div>
