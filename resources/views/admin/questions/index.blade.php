@extends("layouts.app")

@section("first_screen_content")
    <p class="h3">{{ $survey->name }}</p>
    <p class="h1">Список вопросов</p>
    <p class="mt-4"></p>
@endsection

@section("first_screen_image")
@endsection

@section("content")
    @include("components.first_screen")

    <div class="container py-5 d-flex flex-column flex-grow-1">
        <div class="row">
            <div class="col-12">
                <p><a href="{{ AdminRoutes::surveysIndex()  }}">@lang("messages.go_back")</a></p>

                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col" colspan="3" class="text-right">

                            <a href="{{ AdminRoutes::questionsCreate($survey) }}">Создать новый вопрос</a>

                        </th>
                    </tr>
                    </thead>
                    <tbody>

                    @forelse($questions as $question)
                        <tr>
                            <td>{{ $question->id }}</td>
                            <td>{{ $question->name }}</td>

                            <td class="text-right">
                                <a class="btn btn-primary"
                                   href="{{ AdminRoutes::questionsShow($survey, $question) }}">View</a>
                            </td>
                            <td class="text-right">
                                <a class="btn btn-primary"
                                   href="{{ AdminRoutes::questionsEdit($survey, $question) }}">Edit</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3">
                                <p class="text-center">
                                    Нет ответов
                                </p>
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>

                <div class="mt-16 pager-wrapper">{{ $questions->links() }}</div>
            </div>
        </div>
    </div>
@endsection
