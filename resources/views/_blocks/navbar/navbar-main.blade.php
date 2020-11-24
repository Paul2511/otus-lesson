<!-- Header with logos -->
<div class="navbar-header navbar-dark d-none d-md-flex align-items-md-center">
    <div class="navbar-brand navbar-brand-md">
        <a href="#" class="d-inline-block">
            <img src="{{ asset('images/logo_light.png') }}" alt="">
        </a>
    </div>

    <div class="navbar-brand navbar-brand-xs">
        <a href="#" class="d-inline-block">
            <img src="{{ asset('images/logo_icon_light.png') }}" alt="">
        </a>
    </div>
</div>

<!-- Mobile controls -->
@include('_blocks.navbar.mobile-controls')

<!-- Navbar content -->
<div class="collapse navbar-collapse" id="navbar-mobile">

    <!-- Toggle sidebar -->
    @include('_blocks.navbar.sidebar-toggler')

    <span class="badge bg-white-400 badge-pill ml-md-3 mr-md-auto">&nbsp;</span>

    <ul class="navbar-nav">

        <!-- Language menu -->
        @include('_blocks.navbar.lang-menu')

        <!-- User menu -->
        @include('_blocks.navbar.user-menu')

    </ul>
</div>
