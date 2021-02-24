@extends("layouts.app")

@section("first_screen_content")
    <p class="mt-4">Пройти опрос</p>
    <p class="h1">{{ $survey->name }}</p>
@endsection

@section("first_screen_image")
@endsection

@section("content")
    @include("components.first_screen")

    <div class="container py-5 d-flex flex-column flex-grow-1">
        <div class="row">
            <div class="col-7 col-xs-12">

                <div class="survey-questions">

                    @foreach($survey->questions ?? [] as $question)
                        <div class="survey-question">
                            <h3>{{ $question->name }}</h3>
                            {{--<div>{{ $question->name }}</div>--}}

                            <div class="survey-question__answers">
                                @foreach($question->answers ?? [] as $answer)
                                    <input type="radio" name="question-{{ $question->id  }}"
                                           id="answer-{{ $answer->id }}"
                                           value="{{ $answer->id }}"
                                           class="{{ $answer->correct ? 'answer-correct' : 'answer-wrong' }}"
                                           data-survey-switch
                                    >
                                    <label for="answer-{{ $answer->id }}">
                                        <span class="input"></span>
                                        <span>{{ $answer->text }}</span>
                                    </label>
                                @endforeach
                            </div>
                        </div>
                    @endforeach

                </div>

            </div>
        </div>
    </div>
@endsection

@section("custom-assets")
    <link rel="stylesheet" href="{{ asset('css/survey.css') }}">
    <script src="{{ asset('js/survey.js') }}" defer></script>
@endsection
