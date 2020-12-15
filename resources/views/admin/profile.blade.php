@extends('admin.layouts.master')
@section('title', __('messages.users.profile.editProfile'))
@section('style')

@endsection

@section('breadcrumb-title', __('messages.users.profile.editProfile'))
@section('breadcrumb-item')
<li class="breadcrumb-item">{{ __('messages.users.profile.users') }}</li>
<li class="breadcrumb-item active">{{ __('messages.users.profile.editProfile') }}</li>
@endsection

@section('body')
<!-- Container-fluid starts-->
<div class="container-fluid">
  <div class="edit-profile">
    <div class="row">
      <div class="col-lg-4">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title mb-0">{{ __('messages.users.profile.userProfile') }}</h4>
            <div class="card-options"><a class="card-options-collapse" href="#" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a><a class="card-options-remove" href="#" data-toggle="card-remove"><i class="fe fe-x"></i></a></div>
          </div>
          <div class="card-body">
            {{-- User form starts--}}
            {!! Form::open(['url' => 'users/update']) !!}
              <div class="row mb-2">
                <div class="col-auto"><img class="img-70 rounded-circle" alt="" src="{{asset('assets/images/user/7.jpg')}}"></div>
                <div class="col">
                  <h3 class="mb-1">MARK JECNO</h3>
                  <p class="mb-4">HR manager</p>
                </div>
              </div>
              <div class="form-group">
                <h6 class="form-label">{{ __('messages.users.profile.bio') }}</h6>
                {!! Form::textarea('bio', '', ['class' => 'form-control', 'rows'=>'5']) !!}
              </div>
              <div class="form-group">
                {!! Form::label('email', __('messages.users.userEmail'), ['class' => 'form-label']) !!}
                {!! Form::email('email', '', ['class' => 'form-control', 'placeholder' => 'your-email@domain.com', 'required']) !!}
              </div>
              <div class="form-group">
                {!! Form::label('password', __('messages.users.profile.password'), ['class' => 'form-label']) !!}
                {!! Form::password('password', ['class' => 'form-control', 'required']) !!}
              </div>
              <div class="form-group">
                {!! Form::label('website',  __('messages.users.profile.website'), ['class' => 'form-label']) !!}
                {!! Form::text('website', '', ['class' => 'form-control', 'placeholder' => 'sample.com']) !!}
              </div>
              <div class="form-footer">
                {!! Form::submit( Str::ucfirst(__('messages.users.profile.save')),['class' => 'btn btn-primary btn-block'] ) !!}
              </div>
            {!! Form::close() !!}
            {{-- User form ends--}}
          </div>
        </div>
      </div>
      <div class="col-lg-8">
      {{-- Company form starts--}}
      {!! Form::open(['url' => 'users/company/update', 'class' =>'card']) !!}
          <div class="card-header">
            <h4 class="card-title mb-0">{{ __('messages.users.profile.companyProfile') }}</h4>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-md-5">
                <div class="form-group">
                  {!! Form::label('company',  __('messages.users.profile.company'), ['class' => 'form-label']) !!}
                  {!! Form::text('company', '', ['class' => 'form-control', 'placeholder' => __('users/profile.company')]) !!}
                </div>
              </div>
              <div class="col-sm-6 col-md-3">
                <div class="form-group">
                  {!! Form::label('username',  __('messages.users.profile.username'), ['class' => 'form-label']) !!}
                  {!! Form::text('username', '', ['class' => 'form-control', 'placeholder' => __('users/profile.username')]) !!}
                </div>
              </div>
              <div class="col-sm-6 col-md-4">
                <div class="form-group">
                  {!! Form::label('companyEmail',  __('messages.users.profile.companyEmail'), ['class' => 'form-label']) !!}
                  {!! Form::email('companyEmail', '', ['class' => 'form-control', 'placeholder' => __('users/profile.companyEmail')]) !!}
                </div>
              </div>
              <div class="col-sm-6 col-md-6">
                <div class="form-group">
                  {!! Form::label('firstName',  __('messages.users.profile.firstName'), ['class' => 'form-label']) !!}
                  {!! Form::text('firstName', '', ['class' => 'form-control', 'placeholder' => __('users/profile.firstName')]) !!}
                </div>
              </div>
              <div class="col-sm-6 col-md-6">
                <div class="form-group">
                  {!! Form::label('lastName',  __('messages.users.profile.lastName'), ['class' => 'form-label']) !!}
                  {!! Form::text('lastName', '', ['class' => 'form-control', 'placeholder' => __('users/profile.lastName')]) !!}
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  {!! Form::label('address',  __('messages.users.profile.address'), ['class' => 'form-label']) !!}
                  {!! Form::text('address', '', ['class' => 'form-control', 'placeholder' => __('users/profile.address')]) !!}
                </div>
              </div>
              <div class="col-sm-6 col-md-4">
                <div class="form-group">
                  {!! Form::label('city',  __('messages.users.profile.city'), ['class' => 'form-label']) !!}
                  {!! Form::text('city', '', ['class' => 'form-control', 'placeholder' => __('users/profile.city')]) !!}
                </div>
              </div>
              <div class="col-sm-6 col-md-3">
                <div class="form-group">
                  {!! Form::label('postalCode',  __('messages.users.profile.postalCode'), ['class' => 'form-label']) !!}
                  {!! Form::text('postalCode', '', ['class' => 'form-control', 'placeholder' => __('users/profile.postalCode')]) !!}
                </div>
              </div>
              <div class="col-md-5">
                <div class="form-group">
                  {!! Form::label('country',  __('messages.users.profile.country'), ['class' => 'form-label']) !!}
                  <select class="form-control btn-square">
                    <option value="0">{{ __('messages.users.profile.select') }}</option>
                    <option value="1">{{ __('messages.users.profile.ru') }}</option>
                    <option value="2">{{ __('messages.users.profile.ua') }}</option>
                    <option value="3">{{ __('messages.users.profile.ge') }}</option>
                    <option value="4">{{ __('messages.users.profile.ca') }}</option>
                  </select>
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group mb-0">
                  {!! Form::label('about',  __('messages.users.profile.about'), ['class' => 'form-label']) !!}
                  {!! Form::textarea('about', '', ['class' => 'form-control', 'rows'=>'3']) !!}
                </div>
              </div>
            </div>
          </div>
          <div class="card-footer text-right">
            {!! Form::submit( Str::ucfirst(__('messages.users.profile.updateProfile')),['class' => 'btn btn-primary'] ) !!}
          </div>
        {!! Form::close() !!}
        {{-- Company form ends --}}
      </div>
      {{-- Documents block starts--}}
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title mb-0">{{ __('messages.users.profile.projectsAndDocuments') }}</h4>
            <div class="card-options"><a class="card-options-collapse" href="#" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a><a class="card-options-remove" href="#" data-toggle="card-remove"><i class="fe fe-x"></i></a></div>
          </div>
          <div class="table-responsive">
            <table class="table card-table table-vcenter text-nowrap">
              <thead>
                <tr>
                  <th>{{ __('messages.users.profile.projectName') }}</th>
                  <th>{{ __('messages.users.profile.date') }}</th>
                  <th>{{ __('messages.users.profile.status') }}</th>
                  <th>{{ __('messages.users.profile.price') }}</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                {{-- For loop as an example of usage --}}
                @for ($i = 0; $i < 5; $i++)
                <tr>
                  <td><a class="text-inherit" href="#">Untrammelled prevents </a></td>
                  {{-- as an example --}}
                  <td>{{ Date::now()->format('d M Y') }}</td>
                  <td><span class="status-icon bg-success"></span> {{ __('messages.users.profile.completed') }}</td>
                  {{-- as an example --}}
                  <td>$ <?php echo( number_format(rand(10000,99999),2) ) ?> </td>
                  <td class="text-right">
                    <a class="btn btn-primary btn-sm" href="javascript:void(0)"><i class="fa fa-pencil"></i> {{ __('messages.users.profile.edit') }}</a>
                    <a class="btn btn-transparent btn-sm" href="javascript:void(0)"><i class="fa fa-link"></i> {{ __('messages.users.profile.update') }}</a>
                    <a class="btn btn-danger btn-sm" href="javascript:void(0)"><i class="fa fa-trash"></i> {{ __('messages.users.profile.delete') }}</a>
                  </td>
                </tr>
                @endfor
                {{-- For loop as an example of usage --}}
              </tbody>
            </table>
          </div>
        </div>
      </div>
        {{-- Documents block ends--}}
    </div>
  </div>
</div>
<!-- Container-fluid ends-->
@endsection
@section('scripts')
@endsection
