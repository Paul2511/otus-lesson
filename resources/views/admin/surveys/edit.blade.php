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
        <div class="text-right">
            @include("admin.surveys.deleteButton")
        </div>

        {!! Form::open($formOpenOptions) !!}

        <p><a href="{{ AdminRoutes::surveysIndex()  }}">@lang("messages.go_back")</a></p>

        <table class="table">
            <thead>
            <tr>
                <th>@lang("messages.field_name")</th>
                <th>Значение</th>
            </tr>
            </thead>

            <tbody>
            <tr>
                <td>Заголовок опроса</td>
                <td>
                    {{ Form::input('text', 'name', $survey->name, ['class' => 'form-control']) }}
                </td>
            </tr>
            <tr>
                <td>Текст опроса</td>
                <td>
                    {{ Form::textarea('text', $survey->text, ['class' => 'form-control']) }}
                </td>
            </tr>
            <tr>
                <td>Картинка-обложка</td>
                <td>
                    {{ Form::file('picture', ['class' => 'form-control-file']) }}
                    {{--
                    @if($survey->picture)
                        <img src="{{ $survey->picture }}" alt="{{ $survey->name }}">
                    @endif
                    --}}
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
