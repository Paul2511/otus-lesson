<script src="{{asset('assets/js/libs/jquery-3.1.1.min.js')}}"></script>
@extends('layouts.app')
@section('styles')
    <link href="{{asset('assets/css/pages/records/simple.css')}}" rel="stylesheet" type="text/css" />
@endsection
@section('content')

    <div class="layout-px-spacing">


        <div class="filter">
            @include('inc.filter', array('project'=>'project_single',
                'date'=>'date_month',
                'phone'=>'phone'))
        </div>

    </div>

@endsection
