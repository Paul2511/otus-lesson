@extends('layouts.app')
@section('styles')
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/dropify/dropify.min.css')}}">
    <link href="{{asset('assets/css/users/account-setting.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/css/components/cards/card.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/css/components/tabs-accordian/custom-accordions.css')}}" rel="stylesheet" type="text/css" />
    {{-- Components Block ui --}}
    <link href="{{asset('assets/css/scrollspyNav.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/css/components/custom-modal.css')}}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/animate/animate.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/select2/select2.min.css')}}">
    <link href="{{asset('plugins/notification/snackbar/snackbar.min.css')}}" rel="stylesheet" type="text/css" />
{{--    <link rel="stylesheet" type="text/css" href="{{asset('plugins/bootstrap-select/bootstrap-select.min.css')}}">--}}

    <style>
        .blockui-growl-message {
            display: none;
            text-align: left;
            padding: 15px;
            background-color: #455a64;
            color: #fff;
            border-radius: 3px;
        }
        .blockui-animation-container { display: none; }
        .multiMessageBlockUi {
            display: none;
            background-color: #455a64;
            color: #fff;
            border-radius: 3px;
            padding: 15px 15px 10px 15px;
        }
        .multiMessageBlockUi i { display: block }
    </style>
@endsection
@section('scripts')
    <script src="{{asset('plugins/dropify/dropify.min.js')}}"></script>
    <script src="{{asset('assets/js/users/account-settings.js')}}"></script>
    <script src="{{asset('assets/js/users/user-create.js')}}"></script>
    <script src="{{asset('plugins/notification/snackbar/snackbar.min.js')}}"></script>
    <script>
        let user_resources = [];
        let user_projects = [];
        {{--let user_id = "{{$user->id}}";--}}
        let route_store = "{{route(App\Services\Routes\Providers\Admin\AdminRoutes::ADMIN_USERS_STORE) }}";
        let location_good = "{{route(App\Services\Routes\Providers\Admin\AdminRoutes::ADMIN_USERS_INDEX) }}";
    </script>
    {{-- Components Block UI --}}
    <script src="{{asset('plugins/blockui/jquery.blockUI.min.js')}}"></script>
    <script src="{{asset('plugins/blockui/custom-blockui.js')}}"></script>
    <script src="{{asset('plugins/select2/select2.min.js')}}"></script>
    <script src="{{asset('plugins/select2/custom-select2.js')}}"></script>
    <script src="{{asset('plugins/bootstrap-select/bootstrap-select.min.js')}}"></script>
    @endsection
@section('content')
    @include('inc.modals.modal-project')
            <div class="layout-px-spacing">
{{--        <form id="user-data" action="{{route(App\Services\Routes\Providers\Admin\AdminRoutes::ADMIN_USERS_UPDATE, ['user' => $user->id]) }}">--}}
                <div class="account-settings-container layout-top-spacing">

                    <div class="account-content">
                        <div class="scrollspy-example" data-spy="scroll" data-target="#account-settings-scroll" data-offset="-100">
                            <div class="row">
                                <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
                                    <form id="general-info" class="section general-info">
                                        <div class="info">
                                            <h6 class="">@lang('users.General')</h6>
                                            <div class="row">
                                                <div class="col-lg-11 mx-auto">
                                                    <div class="row">
                                                        <div class="col-xl-12 col-lg-12 col-md-8 mt-md-0 mt-4">
                                                            <div class="form">
                                                                <div class="row">
                                                                    <div class="col-sm-5">
                                                                        <div class="form-group">
                                                                            <label for="email">Email</label>
                                                                            <input class="form-control mb-4" id="email" placeholder="" value="" type="email">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-5">
                                                                        <div class="form-group">
                                                                            <label for="password">@lang('users.Password')</label>
                                                                            <input type="text" class="form-control mb-4" id="password" placeholder="" value="">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-2">
                                                                        <div class="form-group" style="text-align: -webkit-right;">
                                                                            <label for="is_admin">@lang('users.IsAdmin')</label>
                                                                            <input style="width: 10%" type="checkbox" class="form-control mb-4" id="is_admin">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-sm-6">
                                                                        <div class="form-group">
                                                                            <label for="fullName">@lang('users.Name')</label>
                                                                            <input type="text" class="form-control mb-4" id="fullName" placeholder="" value="">
                                                                        </div>
                                                                    </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label for="phone">@lang('users.Phone')</label>
                                                                        <input type="text" class="form-control mb-4" id="phone" placeholder="" value="">
                                                                    </div>
                                                                </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
                                    <form id="user_projects" class="section about">
                                        <div class="info">
                                            <div class="blockui-animation-container" id ="blockui-animation-container">
                                                    <span class="text-semibold"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-loader spin no-edge-top"><line x1="12" y1="2" x2="12" y2="6"></line><line x1="12" y1="18" x2="12" y2="22"></line><line x1="4.93" y1="4.93" x2="7.76" y2="7.76"></line><line x1="16.24" y1="16.24" x2="19.07" y2="19.07"></line><line x1="2" y1="12" x2="6" y2="12"></line><line x1="18" y1="12" x2="22" y2="12"></line><line x1="4.93" y1="19.07" x2="7.76" y2="16.24"></line><line x1="16.24" y1="7.76" x2="19.07" y2="4.93"></line></svg>
                                                    </span>
                                            </div>
                                            <h5 class="project">@lang('users.Projects')</h5>
                                            <div class="col-md-12 text-right mb-5 project-margin">
                                                <button id="add-project" class="btn btn-primary" data-toggle="modal" data-target="#NewProjectModal">@lang('users.Add')</button>
                                            </div>
                                            <div id="projects">

                                            </div>
                                        </div>
                                    </form>

                                </div>

                                <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
                                    <form id="user_resources" class="section about">
                                        <div class="info">
                                            <div class="blockui-animation-container" id ="blockui-animation-container1">
                                                    <span class="text-semibold"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-loader spin no-edge-top"><line x1="12" y1="2" x2="12" y2="6"></line><line x1="12" y1="18" x2="12" y2="22"></line><line x1="4.93" y1="4.93" x2="7.76" y2="7.76"></line><line x1="16.24" y1="16.24" x2="19.07" y2="19.07"></line><line x1="2" y1="12" x2="6" y2="12"></line><line x1="18" y1="12" x2="22" y2="12"></line><line x1="4.93" y1="19.07" x2="7.76" y2="16.24"></line><line x1="16.24" y1="7.76" x2="19.07" y2="4.93"></line></svg>
                                                    </span>
                                            </div>
                                            <h5 class="project">@lang('users.Resources')</h5>
                                            <div class="row" style="padding: 5px;">
                                                <div class="table-responsive">
                                                    <div id="resources">
                                                        <div class="card"></div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="account-settings-footer">

                        <div class="as-footer-container">

                            <div> </div>
                            <button id="save-changes" class="btn btn-primary" >@lang('users.CreateUser')</button>
                        </div>

                    </div>

                </div>
{{--        </form>--}}
            </div>
@endsection
