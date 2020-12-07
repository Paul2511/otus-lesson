@extends("layouts.app")

@section("first_screen_content")
    <p class="h3">{{ $survey->name }}</p>
    <p class="h1">Вопросы</p>
    <p class="mt-4"></p>
@endsection

@section("first_screen_image")
@endsection

@section("content")
    @include("components.first_screen")

    <div class="container py-5 d-flex flex-column flex-grow-1">
        <p class="flex justify-content-between">
            <a href="{{ AdminRoutes::questionsIndex($survey) }}">&larr; Назад</a>
            <a href="{{ AdminRoutes::questionsEdit($survey, $question)  }}">Редактировать</a>
        </p>

        <table class="table">
            <thead>
            <tr>
                <th>Название поля</th>
                <th>Значение</th>
            </tr>
            </thead>

            <tbody>
            <tr>
                <td>Заголовок вопроса</td>
                <td>{{ $question->name }}</td>
            </tr>
            <tr>
                <td>Текст вопроса</td>
                <td>{{ $question->text }}</td>
            </tr>
            </tbody>
        </table>

    </div>
@endsection
