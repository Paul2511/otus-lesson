@extends('layouts.app')

@section('page')
    <!-- Main sidebar -->
    <div class="sidebar sidebar-dark sidebar-main sidebar-expand-md">
        @include('_blocks.sidebar.sidebar')
    </div>

    <!-- Main content -->
    <div class="content-wrapper">

        <!-- Page header -->
        <div class="page-header">
            <!-- Breadcrumbs -->
            <div class="page-header-content header-elements-md-inline">
                @include('_blocks.page.breadcrumbs')
            </div>
        </div>

        <!-- Content area -->
        <div class="content pt-0">
            @yield('content')
        </div>

        <!-- Footer -->
        <div class="navbar navbar-expand-lg navbar-light">
            @include('_blocks.page.footer')
        </div>

    </div>
    <!-- /main content -->
@endsection
