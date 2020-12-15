@extends('admin.layouts.master')

@section('title', Str::ucfirst(__('messages.pages.contacts.contacts')))

@section('style')
@endsection

@section('breadcrumb-title', __('messages.pages.contacts.contacts') )
@section('breadcrumb-item')
<li class="breadcrumb-item active">{{ __('messages.pages.contacts.contacts')}}</li>
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
