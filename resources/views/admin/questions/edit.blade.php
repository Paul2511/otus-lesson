@extends("layouts.app")

@section("first_screen_content")
    <p class="h3">{{ $survey->name }}</p>
    <p class="h1">Создать вопрос</p>
    <p class="mt-4"></p>
@endsection

@section("first_screen_image")
@endsection

@section("content")
    @include("components.first_screen")

    <div class="container py-5 d-flex flex-column flex-grow-1">
        <div class="text-right">
            @include("admin.questions.deleteButton")
        </div>

        {!! Form::open($formOpenOptions) !!}

        <p><a href="{{ AdminRoutes::questionsIndex($survey) }}">@lang("messages.go_back")</a></p>

        <table class="table">
            <thead>
            <tr>
                <th>@lang("messages.field_name")</th>
                <th>Значение</th>
            </tr>
            </thead>

            <tbody>
            <tr>
                <td>Заголовок вопроса</td>
                <td>
                    {{ Form::input('text', 'name', $question->name, ['class' => 'form-control']) }}
                </td>
            </tr>
            <tr>
                <td>Текст вопроса</td>
                <td>
                    {{ Form::textarea('text', $question->text, ['class' => 'form-control']) }}
                </td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <div class="d-inline-flex">
                        {{ Form::submit(__('messages.form_submit'), ['class' => 'btn btn-primary']) }}
                    </div>
                </td>
            </tr>
            </tbody>
        </table>

        {!! Form::close() !!}

    </div>
@endsection
