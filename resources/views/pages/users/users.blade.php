@extends('layouts.app')
@section('styles')
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/table/datatable/datatables.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/table/datatable/dt-global_style.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/table/datatable/custom_dt_multiple_tables.css')}}">
    <link href="{{asset('plugins/notification/snackbar/snackbar.min.css')}}" rel="stylesheet" type="text/css" />
@endsection
@section('scripts')
    {{-- Table Datatable Multiple Tables --}}
    <script src="{{asset('plugins/table/datatable/datatables.js')}}"></script>
    <script>
        let results = "@lang('users.Results') :  _MENU_";
        let search = "@lang('users.Search')";
        let sZeroRecords = "@lang('users.sZeroRecords')";
        let sInfo = "@lang('users.Showing') _PAGE_ @lang('users.of') _PAGES_";
        let route_create = "{{route(App\Services\Routes\Providers\Admin\AdminRoutes::ADMIN_USERS_CREATE)}}";

    </script>
    <script src="{{asset('assets/js/users/users.js')}}"></script>
    <script src="{{asset('plugins/notification/snackbar/snackbar.min.js')}}"></script>
@endsection
@section('content')
    <div class="layout-px-spacing">
        <div class="row layout-top-spacing">

            <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                <div class="widget-content widget-content-area br-6">
                    <div class="table-responsive mb-4 mt-4">
                        <table class="multi-table table table-hover" style="width:100%">
                            <thead>
                            <tr>
                                <th></th>
                                <th>@lang('users.Name')</th>
                                <th>@lang('users.Login')</th>
                                <th class="text-center">@lang('users.Actions')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td> @if (!empty($user->is_active))
                                            <div class="t-dot bg-primary" data-toggle="tooltip"
                                                 data-placement="top" title=""
                                                 data-original-title="@lang('users.Active')"></div>
                                        @else
                                            <div class="t-dot bg-danger" data-toggle="tooltip"
                                                 data-placement="top" title=""
                                                 data-original-title="@lang('users.Locked')"></div>
                                        @endif</td>
                                    <td>
                                        {{$user->full_name}}</td>
                                    <td>{{$user->email}}</td>
                                    <td class="text-center">
                                        <button class="btn btn-secondary" >
                                            <a href="{{ route(App\Services\Routes\Providers\Admin\AdminRoutes::ADMIN_USERS_EDIT,['user' => $user])}}">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                 viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                 stroke-width="2" stroke-linecap="round"
                                                 stroke-linejoin="round"
                                                 class="feather feather-edit-2">
                                                <path
                                                    d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path>
                                            </svg>
                                            </a>
                                        </button>

                                            @if (!empty($user->is_active))
                                            <button class="btn btn-danger block-user" data-user="{{$user->id}}"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                     viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                     stroke-width="2" stroke-linecap="round"
                                                     stroke-linejoin="round" class="feather feather-lock">
                                                    <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                                                    <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                                                </svg></button>
                                            @else
                                            <button class="btn btn-danger unblock-user" data-user="{{$user->id}}"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                     viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                     stroke-width="2" stroke-linecap="round"
                                                     stroke-linejoin="round" class="feather feather-unlock">
                                                    <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                                                    <path d="M7 11V7a5 5 0 0 1 9.9-1"></path>
                                                </svg></button>
                                            @endif

                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <th></th>
                                <th>@lang('users.Name')</th>
                                <th>@lang('users.Login')</th>
                                <th class="text-center">@lang('users.Actions')</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
