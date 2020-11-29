@if (isset($survey) && is_object($survey) && $survey->id)

    {!! Form::open([
        'url'=> route(AdminSurveysRoutes::SURVEYS_DESTROY, $survey),
        'method' => 'DELETE']
    ) !!}
    {!! Form::submit(__('surveys.delete_button'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}

@endif