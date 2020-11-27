{{-- User Modal form starts --}}
{!! Form::open(['url' => 'users/register','class' => 'theme-form', 'id' => 'userFormData', 'name' => 'userFormData']) !!}
<h6>{{ __('messages.users.index.accountInformation') }}</h6>
<div class="form-row">
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('first_name',  __('messages.users.index.firstName'), ['class' => 'col-form-label']) !!}
            {!! Form::text('first_name', '', ['class' => 'form-control', 'placeholder' => __('messages.users.index.firstName'), 'required']) !!}
            <div class="invalid-feedback">
                {{ __('messages.users.validate.first_name') }}
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('last_name',  __('messages.users.index.lastName'), ['class' => 'col-form-label']) !!}
            {!! Form::text('last_name', '', ['class' => 'form-control', 'placeholder' => __('messages.users.index.lastName'), 'required']) !!}
            <div class="invalid-feedback">
                {{ __('messages.users.validate.last_name') }}
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('middle_name',  __('messages.users.index.middleName'), ['class' => 'col-form-label']) !!}
            {!! Form::text('middle_name', '', ['class' => 'form-control', 'placeholder' => __('messages.users.index.middleName'), 'required']) !!}
        </div>
    </div>
</div>
<div class="form-row">
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('email', __('messages.users.index.email'), ['class' => 'col-form-label']) !!}
            {!! Form::email('email', '', ['class' => 'form-control', 'placeholder' => 'your-email@domain.com', 'required']) !!}
            <div class="invalid-feedback">
                {{ __('messages.users.validate.email') }}
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('phone', __('messages.users.index.phone'), ['class' => 'col-form-label']) !!}
            {!! Form::text('phone', '', ['class' => 'form-control', 'placeholder' => '+X (XXX) XXX-XX-XX', 'required']) !!}
            <div class="invalid-feedback">
                {{ __('messages.users.validate.phone') }}
            </div>
        </div>
    </div>
</div>
<div class="form-row">
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('password', __('messages.users.index.password'), ['class' => 'col-form-label']) !!}
            {!! Form::password('password', ['class' => 'form-control', 'required']) !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('confirm', __('messages.users.index.confirm'), ['class' => 'col-form-label']) !!}
            {!! Form::password('confirm', ['class' => 'form-control', 'required']) !!}
        </div>
    </div>
</div>
<h6>{{ __('messages.users.index.affilatedInformation') }}</h6>
<div class="form-row">
    <div class="col-md-4">
        <div class="form-group">
            {!! Form::label('affilatedCompany',  __('messages.users.index.affilatedCompany'), ['class' => 'col-form-label']) !!}
            {!! Form::text('affilatedCompany', '', ['class' => 'form-control', 'placeholder' => __('messages.users.index.affilatedCompany'), 'required']) !!}
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            {!! Form::label('position',  __('messages.users.index.position'), ['class' => 'col-form-label']) !!}
            {!! Form::text('position', '', ['class' => 'form-control', 'placeholder' => __('messages.users.index.position'), 'required']) !!}
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            {!! Form::label('counterpartyInn',  __('messages.users.index.counterpartyInn'), ['class' => 'col-form-label']) !!}
            {!! Form::text('counterpartyInn', '', ['class' => 'form-control', 'placeholder' => __('messages.users.index.counterpartyInn'), 'required']) !!}
        </div>
    </div>
</div>
<h6>{{ __('messages.users.index.statusRole') }}</h6>
<div class="form-row">
    <div class="col-md-4">
        <div class="form-group">
            {!! Form::label('status',  __('messages.users.index.status'), ['class' => 'col-form-label']) !!}
            {!! Form::select('status', $statuses, '10',['class' => 'form-control']) !!}
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            {!! Form::label('role',  __('messages.users.index.role'), ['class' => 'col-form-label']) !!}
            {!! Form::select('role', $roles, '0',['class' => 'form-control']) !!}
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <div class="checkbox mt-4 pt-2 pl-2">
                {!! Form::checkbox('sendEmail','0', false, ['id' => 'sendEmail']) !!}
                {!! Form::label('sendEmail', __('messages.users.index.sendEmail'), ['for' => 'sendEmail']) !!}
            </div>
        </div>
    </div>
</div>
</div>
</div>
<div class="modal-footer">
    {!! Form::hidden('user_id', '0', ['id' => 'user_id']) !!}
    {!! Form::button( Str::ucfirst(__('messages.users.index.cancel')),['class' => 'btn btn-light','data-dismiss'=>'modal'] ) !!}
    {!! Form::button( Str::ucfirst(__('messages.users.index.createUser')),['id'=>'btn-save', 'class' => 'btn btn-primary', 'value' => '0'] ) !!}
</div>
{!! Form::close() !!}
{{-- User Modal form ends--}}