@extends("layouts.app")

@section("first_screen_content")
    <p class="h1">Опросы</p>
    <p class="mt-4"></p>
@endsection

@section("first_screen_image")
@endsection

@section("content")
    @include("components.first_screen")

    <div class="container py-5 d-flex flex-column flex-grow-1">
        <p class="flex justify-content-between">
            <a href="{{ AdminRoutes::surveysIndex()  }}">&larr; Назад</a>
            @if ($canUpdate)
                <a href="{{ AdminRoutes::surveysEdit($survey)  }}">Редактировать</a>
            @endif
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
                <td>Заголовок опроса</td>
                <td>{{ $survey->name }}</td>
            </tr>
            <tr>
                <td>Текст опроса</td>
                <td>{{ $survey->text }}</td>
            </tr>
            <tr>
                <td>Картинка-обложка</td>
                <td>
                    @if($survey->picture)
                        <img src="{{ $survey->picture }}" alt="{{ $survey->name }}">
                    @endif
                </td>
            </tr>
            </tbody>
        </table>

    </div>
@endsection
