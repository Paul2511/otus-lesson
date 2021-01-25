@extends('cms.layouts.cms-app')
@section('content')
    @include('cms.menus.menu-breadcrumb')
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">
                        @lang('cms-general.country-create')
                    </h6>
                    {{ Form::open(array('route' => \App\Services\Routes\CMS\CMSRoutes::CMS_COUNTRIES_STORE,'class'=>'forms-sample','method'=>'post')) }}
                    @include('cms.parts.errors')
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                {{Form::label('country_code', __('cms-country.country_code')) }}
                                {{Form::text('country_code', null,['class'=>'form-control'])}}
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                {{Form::label('country_name', __('cms-country.country_name')) }}
                                {{Form::text('country_name', null,['class'=>'form-control'])}}
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                {{Form::label('capital', __('cms-country.capital')) }}
                                {{Form::text('capital', null,['class'=>'form-control'])}}
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                {{Form::label('languages', __('cms-country.languages')) }}
                                {{Form::text('languages', null,['class'=>'form-control'])}}
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                {{Form::label('code_phone', __('cms-country.code_phone')) }}
                                {{Form::text('code_phone', null,['class'=>'form-control'])}}
                            </div>
                        </div>
                        <div class="col-sm-4 pt-4">
                            <div class="form-check ">
                                <label for="data_show" class="form-check-label">
                                    {{Form::checkbox('data_show', '1',true,['class'=>'form-check-input','id'=>'data_show'])}}
                                    @lang('cms-country.data_show')
                                    <i class="input-frame"></i>
                                    <i data-feather=""></i>
                                </label>

                            </div>
                        </div>
                    </div>
                    <div class="">
                        {{Form::submit(__('cms-general.create'),['class'=>'btn btn-primary'])}}
                        <a href="{{route(\App\Services\Routes\CMS\CMSRoutes::CMS_COUNTRIES_INDEX)}}"
                           class="btn btn-danger ml-3">@lang('cms-general.cancel')</a>
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
@endsection
