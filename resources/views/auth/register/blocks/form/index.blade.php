{!! Form::open([]) !!}
    <div class="mt-10">
        {{Form::label('name', 'Имя (*)')}}
        {{Form::text("name", $value=old('name'), $attributes = ['class' => 'single-input'])}}
    </div>
    <div class="mt-10">
        {{Form::label('email', 'Email (*)')}}
        {{Form::text("email", $value=old('email'), $attributes = ['class' => 'single-input'])}}
    </div>
    <div class="mt-10">
        {{Form::label('phone', 'Номер телефона (*)')}}
        {{Form::text("phone", $value=old('phone'), $attributes = ['class' => 'single-input'])}}
    </div>
    <div class="mt-10">
        {{Form::submit('Зарегистрироваться', ['class' => 'genric-btn info circle'])}}
    </div>
{!! Form::close() !!}
