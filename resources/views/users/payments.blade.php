@extends('users.layouts.master')

@section('title', Str::ucfirst(__('messages.pages.payments.payments')))

@section('style')
@endsection

@section('breadcrumb-title', __('messages.pages.payments.payments') )
@section('breadcrumb-item')
<li class="breadcrumb-item active">{{ __('messages.pages.payments.payments')}}</li>
@endsection

@section('body')
<!-- Container-fluid starts-->
<div class="container-fluid">
  <div class="row">
    <div class="col-sm-12">

    </div>
  </div>
</div>
<!-- Container-fluid Ends-->

@endsection

@section('script')

@endsection
