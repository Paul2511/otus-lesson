@extends('layouts.app')
@section('styles')
    <link href="{{asset('assets/css/pages/records/simple.css')}}" rel="stylesheet" type="text/css" />
@endsection
@section('content')

    <div class="layout-px-spacing">


        <div class="filter">
            @include('inc.filter', array('project'=>'project_single',
                'date'=>'date_single',
                'phone'=>'phone'))
        </div>

    </div>

@endsection
