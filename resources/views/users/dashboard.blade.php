@extends('users.layouts.master')

@section('title', __('Dashboard'))

@section('style')
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/prism.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/date-picker.css')}}">
@endsection

@section('breadcrumb-title', __('messages.pages.dashboard.dashboard'))
@section('breadcrumb-item')
<li class="breadcrumb-item active"> {{__('messages.pages.dashboard.dashboard')}}</li>
@endsection

@section('body')
<!-- Container-fluid starts-->
<div class="container-fluid">
  <div class="row starter-main">
    {{-- Top widgets --}}
    @include('users._partials._widgets')
    {{-- Orders Card --}}
    @include('users._partials._orders')
    {{-- Calendar Card --}}
    @include('users._partials._calendar')
  </div>
</div>
<!-- Container-fluid Ends-->
@endsection

@section('script')
<script src="{{asset('assets/js/config.js')}}"></script>
<script src="{{asset('assets/js/prism/prism.min.js')}}"></script>
<script src="{{asset('assets/js/clipboard/clipboard.min.js')}}"></script>
<script src="{{asset('assets/js/custom-card/custom-card.js')}}"></script>
<script src="{{asset('assets/js/datepicker/date-picker/datepicker.js')}}"></script>
<script src="{{asset('assets/js/datepicker/date-picker/datepicker.en.js')}}"></script>
<script src="{{asset('assets/js/datepicker/date-picker/datepicker.custom.js')}}"></script>
@endsection
