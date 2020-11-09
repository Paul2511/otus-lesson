{{ Form::open() }}
<div class="row">
    <div class="col-sm-12 col-md-6 col-lg-6">
        <div class="form-group">
            @lang('views.account_form_field_photo')
        </div>
        <div class="form-group">
            {{ Form::label('photo', trans('views.account_form_field_photo_load')) }}
            {{ Form::file('photo', null, ['class' => 'form-control']) }}
        </div>
    </div>
    <div class="col-sm-12 col-md-6 col-lg-6">
        <div class="form-group">
            {{ Form::label('email', trans('views.account_form_field_email')) }}
            {{ Form::email('email', null, ['class' => 'form-control']) }}
        </div>
        <div class="form-group">
            {{ Form::label('phone', trans('views.account_form_field_phone')) }}
            {{ Form::tel('phone', null, ['class' => 'form-control']) }}
        </div>
    </div>
    <div class="col-sm-12 col-md-6 col-lg-6">
        <div class="form-group">
            {{ Form::label('pass_old', trans('views.account_form_field_pass_old')) }}
            {{ Form::text('pass_old', null, ['class' => 'form-control', 'type' => 'password']) }}
        </div>
        <div class="form-group">
            {{ Form::label('pass', trans('views.account_form_field_pass')) }}
            {{ Form::text('pass', null, ['class' => 'form-control', 'type' => 'password']) }}
        </div>
        <div class="form-group">
            {{ Form::label('pass_confirmation', trans('views.account_form_field_pass_confirmation')) }}
            {{ Form::text('pass_confirmation', null, ['class' => 'form-control', 'type' => 'password']) }}
        </div>
    </div>
</div>
<div class="form-group">
    {{ Form::submit(trans('views.account_form_submit'), ['class' => 'btn btn-success']) }}
</div>
{{ Form::token() }}
{{ Form::close() }}
