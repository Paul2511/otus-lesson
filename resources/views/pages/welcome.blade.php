@extends("layouts.app")

@section("first_screen_content")
    @include("components.weather")

    <p class="h1">{{ config('app.name', 'Survius') }} &mdash; @lang("messages.is")</p>
    <p class="mt-4">@lang("home.description")</p>

    <a href="{{ PublicRoutes::surveys() }}" class="btn btn-success">Пройти доступные опросы</a>
@endsection

@section("first_screen_image")
    <img src="/img/quiz-demo.png" alt="Quiz Demo">
@endsection

@section("content")
    @include("components.first_screen")

    <div class="d-flex flex-column flex-grow-1">
        <div class="py-5">
            <div class="container">
                <div class="row">
                    <div class="col-lg-5 col-12 py-5 py-lg-0">
                        <img src="https://placehold.it/500" class="d-block m-auto" alt="">
                    </div>

                    <div class="col-lg-7 col-12 d-flex flex-column justify-content-center text-lg-left text-center">
                        <p class="h2">@lang("home.create_polls")</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="bgc-cyan color-white py-5">
            <div class="container">
                <div class="row">
                    <div class="col-lg-7 col-12 d-flex flex-column justify-content-center text-lg-left text-center">
                        <p class="h2">@lang("home.conduct_marketing_research")</p>
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
                        <p class="h2">@lang("home.collect_feedback")</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
