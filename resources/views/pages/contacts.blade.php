@extends("layouts.app")

@section("first_screen_content")
    <p class="h1">@lang("contacts.heading")</p>
    <p class="mt-4">@lang("contacts.description")</p>
@endsection

@section("first_screen_image")
    <img src="/img/contact-us-map.jpg" alt="Contact us">
@endsection

@section("content")
    @include("components.first_screen")

    <div class="container py-5 d-flex flex-column flex-grow-1">
        <div class="row">
            <div class="col-lg-5 col-12 d-flex justify-content-center">
                <img src="/img/contact-us.jpg" alt="Contact us">
                {{--<img src="/img/contact-us-map.jpg" alt="">--}}
            </div>

            <div class="col-lg-7 col-12 mt-5 mt-lg-0 flex-cell flex-cell--centered">
                <p class="h2">@lang("messages.contact_us")</p>

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
