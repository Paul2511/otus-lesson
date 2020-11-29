@extends('layouts.app')

@section('page')
    <!-- Main content -->
    <div class="content-wrapper">

        <!-- Content area -->
        @yield('content')

        <!-- Footer -->
        <div class="navbar navbar-expand-lg navbar-light">
            @include('_blocks.page.footer')
        </div>

    </div>
    <!-- /main content -->
@endsection
