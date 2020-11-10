{!! Form::open([]) !!}
    <div class="mt-10">
        {{Form::label('name', 'Имя (*)')}}
        {{Form::text("name", null, ['class' => 'single-input'])}}
    </div>
    <div class="mt-10">
        {{Form::label('email', 'Email (*)')}}
        {{Form::text("email", null, ['class' => 'single-input'])}}
    </div>
    <div class="mt-10">
        {{Form::label('phone', 'Номер телефона (*)')}}
        {{Form::text("phone", null, ['class' => 'single-input'])}}
    </div>
    <div class="mt-10">
        {{Form::submit('Зарегистрироваться', ['class' => 'genric-btn info circle'])}}
    </div>
{!! Form::close() !!}
