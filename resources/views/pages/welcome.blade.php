@extends("layouts.app")

@section("content")
    <div class="home-banner bg-primary py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-12 col-content">
                    <p class="h1">{{ config('app.name', 'Survius') }} &mdash; @lang("is")</p>
                    <div class="home-banner__content mt-4">
                        <p>@lang("home.description")</p>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 pl-lg-2 pt-4 pt-lg-0">
                    <div class="home-banner__mockup">
                        <img src="/img/quiz-demo.png" alt="Quiz Demo">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="d-flex flex-column flex-grow-1">
        <div class="py-5">
            <div class="container">
                <div class="row">
                    <div class="col-lg-5 col-12 py-5 py-lg-0">
                        <img src="https://placehold.it/500" class="d-block m-auto" alt="">
                    </div>

                    <div class="col-lg-7 col-12 d-flex flex-column justify-content-center text-lg-left text-center">
                        <p class="h2">@lang("Create polls")</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="bgc-cyan color-white py-5">
            <div class="container">
                <div class="row">
                    <div class="col-lg-7 col-12 d-flex flex-column justify-content-center text-lg-left text-center">
                        <p class="h2">@lang("Conduct marketing research")</p>
                    </div>

                    <div class="col-lg-5 col-12 py-5 py-lg-0">
                        <img src="https://placehold.it/500" class="d-block m-auto" alt="">
                    </div>
                </div>
            </div>
        </div>

        <div class="py-5">
            <div class="container">
                <div class="row">
                    <div class="col-lg-5 col-12 py-5 py-lg-0">
                        <img src="https://placehold.it/500" class="d-block m-auto" alt="">
                    </div>

                    <div class="col-lg-7 col-12 d-flex flex-column justify-content-center text-lg-left text-center">
                        <p class="h2">@lang("Collect Feedback")</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
