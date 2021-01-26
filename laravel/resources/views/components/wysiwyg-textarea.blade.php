{{ Form::hidden($field, htmlspecialchars($value), ['id'=>$id]) }}
<div class="{{ $textareaClass }} visRedactor" data-name="{{ $editorName }}" data-selector="#{{ $id }}">
    {!! $value  !!}
</div>
