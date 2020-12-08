@extends('cms.layouts.cms-app')
@section('content')
    @include('cms.menus.meniu-breadcrumb')
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">
                        @lang('cms-general.user-create')
                    </h6>
                    {{ Form::open(array('route' => \App\Services\Routes\CMS\CMSRoutes::CMS_USERS_STORE,'class'=>'forms-sample','metod'=>'post')) }}
                    @include('cms.parts.errors')
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                {{Form::label('first_name', __('users.first_name')) }}
                                {{Form::text('first_name', null,['class'=>'form-control'])}}
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                {{Form::label('last_name', __('users.last_name')) }}
                                {{Form::text('last_name', null,['class'=>'form-control'])}}
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                {{Form::label('email', __('users.mail')) }}
                                {{Form::email('email', null,['class'=>'form-control','id'=>'email'])}}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                {{Form::label('phone', __('users.phone')) }}
                                {{Form::text('phone', null,['class'=>'form-control'])}}
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                {{Form::label('type', __('users.type')) }}
                                {{Form::select('type', $types,['class'=>'form-control'])}}
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                {{Form::label('status', __('users.status')) }}
                                {{Form::select('status', $statuses,['class'=>'form-control'])}}
                            </div>
                        </div>
                    </div>
                    <div class="">
                        {{Form::submit(__('cms-general.create'),['class'=>'btn btn-primary'])}}
                        <a href="{{route(\App\Services\Routes\CMS\CMSRoutes::CMS_USERS_INDEX)}}" class="btn btn-danger ml-3">@lang('cms-general.cancel')</a>
                    </div>

                    {{ Form::close() }}

                </div>
            </div>
        </div>
    </div>
@endsection
