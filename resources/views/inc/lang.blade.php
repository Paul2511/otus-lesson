<div class="nav-item dropdown language-dropdown">
    <a href="javascript:void(0);" class="nav-link dropdown-toggle" id="language-dropdown" data-toggle="dropdown"
       aria-haspopup="true" aria-expanded="false">
        @switch(\App::getLocale())
            @case('ru')
            <img src="{{asset('storage/img/ru.png')}}" class="flag-width" alt="flag">
            @break
            @case('en')
            <img src="{{asset('storage/img/uk.png')}}" class="flag-width" alt="flag">
            @break
            @default
            <img src="{{asset('storage/img/ru.png')}}" class="flag-width" alt="flag">
        @endswitch
    </a>
    <div class="dropdown-menu position-absolute" aria-labelledby="language-dropdown">
        <a class="dropdown-item d-flex" href="javascript:void(0);"><img src="{{asset('storage/img/ru.png')}}"
                                                                        class="flag-width" alt="flag"> <span
                class="align-self-center">&nbsp;Русский</span></a>
        <a class="dropdown-item d-flex" href="javascript:void(0);"><img src="{{asset('storage/img/uk.png')}}"
                                                                        class="flag-width" alt="flag"> <span
                class="align-self-center">&nbsp;English</span></a>
    </div>
</div>


