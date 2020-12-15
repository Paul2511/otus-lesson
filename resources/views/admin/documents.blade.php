@extends('admin.layouts.master')

@section('title', Str::ucfirst(__('messages.pages.documents.documents')))

@section('style')
@endsection

@section('breadcrumb-title', __('messages.pages.documents.documents') )
@section('breadcrumb-item')
<li class="breadcrumb-item active">{{ __('messages.pages.documents.documents')}}</li>
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
