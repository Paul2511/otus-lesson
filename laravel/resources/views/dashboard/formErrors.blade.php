@if($errors->all())
    @foreach($errors->all() as $error)
        {{ $error }}
    @endforeach
@endif
