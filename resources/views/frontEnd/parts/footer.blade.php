<footer class="footer">
    <div class="container">
        <div>
            <ul class="nav">
                <li class="nav-item"><a class="nav-link" href="#">@lang('menu.about')</a></li>
                <li class="nav-item"><a class="nav-link" href="#">@lang('menu.open_data')</a></li>
                <li class="nav-item"><a class="nav-link" href="#">@lang('menu.news')</a></li>
                <li class="nav-item"><a class="nav-link" href="#">@lang('menu.terms')</a></li>
                <li class="nav-item"><a class="nav-link" href="#">@lang('menu.policy_cookie')</a></li>
                <li class="nav-item"><a class="nav-link" href="#"
                                        class="hidden-footer-contacts">@lang('menu.contact')</a></li>
            </ul>
        </div>

        <div class="d-flex align-items-center">
            <img src="/images/edata-logo.svg" alt="Logo" width="150">
            <div class="p-2 mt-2 mb-2">@lang('base.footer_content')</div>
        </div>
    </div>
    <div class="copyright">
        <div class="container">
            <div class="row">
                <span>© {{date('Y')}} eData | @lang('base.all_rights_reserved')</span>
                <div class="d-flex box-pays-icons">
                    <div class="box-pay-icon" id="mastercard"></div>
                    <div class="box-pay-icon" id="visa"></div>
                    <div class="box-pay-icon" id="bitcoin"></div>
                    <div class="box-pay-icon" id="paynet"></div>
                    <div class="box-pay-icon" id="yandex"></div>
                    <div class="box-pay-icon" id="qiwi"></div>
                </div>
            </div>
        </div>
    </div>

</footer>
