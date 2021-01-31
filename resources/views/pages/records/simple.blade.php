<script src="{{asset('assets/js/libs/jquery-3.1.1.min.js')}}"></script>
@extends('layouts.app')
@section('styles')
    <link href="{{asset('assets/css/pages/records/simple.css')}}" rel="stylesheet" type="text/css" />
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
        let route_get_records = "{{route(App\Services\Routes\Providers\Sources\SourcesRoutes::SOURCES_SIMPLE_GET_RECORDS)}}";

    </script>
    <script src="{{asset('plugins/notification/snackbar/snackbar.min.js')}}"></script>
    <script src="{{asset('assets/js/records/simple-records.js')}}"></script>
@endsection
@section('content')

    <div class="layout-px-spacing">


        <div  class="filter">
            @include('inc.filter', array('project'=>'project_single',
                'date'=>'date_period',
                'phone'=>'phone',
                'button'=>'build'))
        </div>

        <div class="records">
            <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                <div class="widget-content widget-content-area br-6">
                    <div class="table-responsive mb-4 mt-4">
                        <table class="multi-table table table-hover" style="width:100%" id="records">
                            <thead>
                            <tr>
                                <th>@lang('records.Calldate')</th>
                                <th>@lang('records.Phone')</th>
                                <th class="text-center">@lang('records.Billsec')</th>
                                <th class="text-center">@lang('records.Record')</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>

                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection
