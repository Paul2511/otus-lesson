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
        <div class="row">
            <div class="col-12">

                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col" colspan="3" class="text-right">

                            <a href="{{ AdminRoutes::surveysCreate() }}">Создать новый опрос</a>

                        </th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($surveys as $survey)
                        <tr>
                            <th scope="row">{{ $survey->id }}</th>
                            <td>{{ $survey->name }}</td>
                            <td class="text-right">
                                <a class="btn btn-primary"
                                   href="{{ AdminRoutes::surveysShow($survey) }}">View</a>
                            </td>
                            <td class="text-right">
                                <a class="btn btn-primary"
                                   href="{{ AdminRoutes::surveysEdit($survey) }}">Edit</a>
                            </td>
                            <td class="text-right">
                                @include("admin.surveys.deleteButton")
                            </td>
                        </tr>
                        <tr>
                            <td colspan="1"></td>
                            <td colspan="1">
                                <a href="{{ AdminRoutes::questionsIndex($survey) }}">Посмотреть вопросы</a>
                            </td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>

                <div class="mt-16 pager-wrapper">{{$surveys->links()}}</div>
            </div>
        </div>
    </div>
@endsection
