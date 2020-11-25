@extends('admin.layouts.master')

@section('title', Str::ucfirst(__('pages/knowledgebase.knowledgebase')))

@section('style')
@endsection

@section('breadcrumb-title', __('pages/knowledgebase.knowledgebase') )
@section('breadcrumb-item')
<li class="breadcrumb-item active">{{ __('pages/knowledgebase.knowledgebase')}}</li>
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
