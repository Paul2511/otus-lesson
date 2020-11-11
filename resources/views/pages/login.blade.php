@extends("layouts.app")

@section("first_screen_content")
    <p class="h1">@lang("register.heading")</p>
    <p class="mt-4">@lang("register.description")</p>
@endsection

@section("content")
    @include("components.first_screen")

    <div class="home-banner bg-primary py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-12 col-content">
                    <p class="h1">@lang("login.heading")</p>
                    <p class="mt-4">@lang("login.description")</p>
                </div>
            </div>
        </div>
    </div>

    <div class="py-5 d-flex flex-column flex-grow-1">
        <div class="container">
            <div class="row">

                <div class="col-md-7 col-lg-6 col-12">
                    @include("components.form.login")
                </div>

            </div>
        </div>
    </div>
@endsection
