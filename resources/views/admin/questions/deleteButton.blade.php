@if (($survey->id ?? false) && ($question->id ?? false))

    {!! Form::open([
        'url'=> AdminRoutes::questionsDestroy($survey, $question),
        'method' => 'DELETE']
    ) !!}
    {!! Form::submit(__('surveys.delete_button'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}

@endif