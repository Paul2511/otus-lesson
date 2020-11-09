@extends("layouts.app")

@section("content")
    <div class="home-banner bg-primary py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-12 col-content">
                    <p class="h1">@lang("Contacts")</p>
                    <div class="home-banner__content mt-4">
                        <p>@lang("You can find our contact information on this page")</p>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 pl-lg-2 pt-4 pt-lg-0">
                    <div class="home-banner__mockup">
                        <img src="/img/contact-us-map.jpg" alt="Contact us">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container py-5 d-flex flex-column flex-grow-1">
        <div class="row">
            <div class="col-lg-5 col-12 d-flex justify-content-center">
                <img src="/img/contact-us.jpg" alt="Contact us">
                {{--<img src="/img/contact-us-map.jpg" alt="">--}}
            </div>

            <div class="col-lg-7 col-12 mt-5 mt-lg-0 flex-cell flex-cell--centered">
                <p class="h2">@lang("Contact us")</p>

                <ul>
                    <li>
                        VK:
                        <a href="https://vk.com/@lang("contacts.vk_login")" target="_blank">
                            {{ '@' . __("contacts.vk_login") }}
                        </a>
                    </li>
                    <li>
                        Telegram:
                        <a href="https://t.me/@lang("contacts.tg_login")" target="_blank">
                            {{ '@' . __("contacts.tg_login") }}
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

@endsection
