@if (($survey->id ?? false) && ($question->id ?? false))

    {!! Form::open([
        'url'=> route(AdminSurveysRoutes::QUESTIONS_DESTROY, $survey, $question),
        'method' => 'DELETE']
    ) !!}
    {!! Form::submit(__('surveys.delete_button'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}

@endif