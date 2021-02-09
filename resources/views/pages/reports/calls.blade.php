@extends('layouts.app')
@section('styles')
    <link href="{{asset('assets/css/pages/reports/calls.css')}}" rel="stylesheet" type="text/css" />
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
        let route_get_report = "{{route(App\Services\Routes\Providers\Sources\SourcesRoutes::SOURCES_REPORT_CALLS_BUILD)}}";

    </script>
    <script src="{{asset('plugins/notification/snackbar/snackbar.min.js')}}"></script>
    <script src="{{asset('assets/js/reports/report-calls.js')}}"></script>
@endsection
@section('content')

    <div class="layout-px-spacing">
        <div  class="filter">
            @include('inc.filter', array('project'=>'project_single',
                'date'=>'date_period',
                'button'=>'build'))
        </div>


    </div>

@endsection
