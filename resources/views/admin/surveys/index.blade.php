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
        @if (\Session::has('surveysIndexSuccess'))
            <div class="alert alert-success mb-5">
                {!! \Session::get('surveysIndexSuccess') !!}
            </div>
        @endif

        <div class="row">
            <div class="col-12">

                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col" colspan="3" class="text-right">

                            @if ($canCreate)
                                <a href="{{ AdminRoutes::surveysCreate() }}">Создать новый опрос</a>
                            @endif

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
                                   href="{{ AdminRoutes::surveysShow($survey) }}">@lang("View")</a>
                            </td>
                            <td class="text-right">
                                @if ($user->can(Permission::UPDATE, $survey))
                                    <a class="btn btn-primary"
                                       href="{{ AdminRoutes::surveysEdit($survey) }}">@lang("Edit")</a>
                                @endif
                            </td>
                            <td class="text-right">
                                @if ($user->can(Permission::DELETE, $survey))
                                    @include("admin.surveys.deleteButton")
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td colspan="1"></td>
                            <td colspan="1">
                                <a href="{{ AdminRoutes::questionsIndex($survey) }}">@lang("Посмотреть вопросы")</a>
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
