{{ Form::open() }}
<div class="row">
    <div class="col-sm-12 col-md-6 col-lg-6">
        <div class="form-group">
            {{ Form::label('login', trans('views.reg_form_field_login')) }}
            {{ Form::text('login', null, ['class' => 'form-control']) }}
        </div>
        <div class="form-group">
            {{ Form::label('email', trans('views.reg_form_field_email')) }}
            {{ Form::email('email', null, ['class' => 'form-control']) }}
        </div>
        <div class="form-group">
            {{ Form::label('phone', trans('views.reg_form_field_phone')) }}
            {{ Form::tel('phone', null, ['class' => 'form-control']) }}
        </div>
    </div>
    <div class="col-sm-12 col-md-6 col-lg-6">
        <div class="form-group">
            {{ Form::label('pass', trans('views.reg_form_field_pass')) }}
            {{ Form::text('pass', null, ['class' => 'form-control', 'type' => 'password']) }}
        </div>
        <div class="form-group">
            {{ Form::label('pass_confirmation', trans('views.reg_form_field_pass_confirmation')) }}
            {{ Form::text('pass_confirmation', null, ['class' => 'form-control', 'type' => 'password']) }}
        </div>
    </div>
</div>
<div class="form-group">
    <div class="form-check">
        {{ Form::checkbox('policy_accept', null, ['class' => 'form-control']) }}
        {{ Form::label('policy_accept', trans('views.reg_form_policy_check')) }}
    </div>
    {{ Form::submit(trans('views.reg_form_submit'), ['class' => 'btn btn-success']) }}
</div>
{{ Form::token() }}
{{ Form::close() }}
