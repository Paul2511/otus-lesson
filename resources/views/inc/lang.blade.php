<div class="nav-item dropdown language-dropdown">
    <a href="javascript:void(0);" class="nav-link dropdown-toggle" id="language-dropdown" data-toggle="dropdown"
       aria-haspopup="true" aria-expanded="false">
        @switch(App::getLocale())
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
        <a class="dropdown-item d-flex lang ru" data-lang="ru" href="javascript:void(0);"><img src="{{asset('storage/img/ru.png')}}"
                                                                        class="flag-width" alt="flag"> <span
                class="align-self-center">&nbsp;Русский</span></a>
        <a class="dropdown-item d-flex lang en" data-lang="en" href="javascript:void(0);"><img src="{{asset('storage/img/uk.png')}}"
                                                                        class="flag-width" alt="flag"> <span
                class="align-self-center">&nbsp;English</span></a>
    </div>
</div>
<script type="application/javascript">
    jQuery(document).ready(function($) {
    let set_locale = "{{route(App\Services\Routes\Providers\Helpers\HelpersRoutes::SET_LOCALE) }}";
    $('.lang').click(function (e) {
       let locale = $(this).data('lang');
        $.ajax({
            type: 'POST',
            beforeSend: function (xhr) { // Add this line
                xhr.setRequestHeader('X-CSRF-Token', $('[name="_token"]').val());
            },  // Add this line
            url: set_locale,
            data: {locale: locale},
            dataType: 'json',
            success: function (respond) {
                window.location.reload();
            },
            error: function (jqXHR, textStatus, errorThrown) {
                window.location.reload();
            }
        });
    });
    });
</script>






