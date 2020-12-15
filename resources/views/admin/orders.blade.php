@extends('admin.layouts.master')

@section('title', Str::ucfirst(__('messages.pages.orders.orders')))

@section('style')
@endsection

@section('breadcrumb-title', __('messages.pages.orders.orders') )
@section('breadcrumb-item')
<li class="breadcrumb-item active">{{ __('messages.pages.orders.orders')}}</li>
@endsection
{{-- Add new Order button starts --}}
@section('bookmark')
  <div class="col">
  <div class="bookmark pull-right">
    <a class="btn btn-success btn m-2" href="#" data-original-title="" title=""><span class="fa fa-plus"></span> {{ __('pages/orders.add')}}</a>
  </div>
  </div>
@endsection
{{-- Add new Order button ends --}}
@section('body')
<!-- Container-fluid starts-->
<div class="container-fluid">
  <div class="row">
    {{-- Order list starts --}}
    <div class="col-sm-12">
      <div class="card">
        <div class="card-header">
          <h5>{{ __('messages.pages.orders.ordersList')}}</h5>
        </div>
        <div class="card-block row">
          <div class="col-sm-12 col-lg-12 col-xl-12">
            <div class="table-responsive">
              <table class="table">
                <thead class="table-primary">
                  <tr class="text-center">
                    <th scope="col">#</th>
                    <th scope="col">{{ __('messages.pages.orders.customer')}}</th>
                    <th scope="col">{{ __('messages.pages.orders.name')}}</th>
                    <th scope="col">{{ __('messages.pages.orders.date')}}</th>
                    <th scope="col">{{ __('messages.pages.orders.status')}}</th>
                    <th scope="col">{{ __('messages.pages.orders.action')}}</th>
                  </tr>
                </thead>
                <tbody>
                  @for ($i = 1; $i < 8; $i++)
                  <tr class="text-center">
                    <th scope="row">{{ $i }}</th>
                    <td>{{ __('messages.pages.orders.company')}}</td>
                    <td>{{ __('messages.pages.orders.jd')}}</td>
                    <td>{{ Date::now()->format('d M Y') }}</td>
                    <td class="txt-secondary">{{ __('messages.pages.orders.pending')}}</td>
                    <td>
                      <div class="btn-group">
                      <a href="#" class="btn btn-secondary btn-sm" title="{{ __('messages.pages.orders.edit')}}"> <span class="fa fa-pencil"></span> </a>
                      <a href="#" class="btn btn-danger btn-sm" title="{{ __('messages.pages.orders.delete')}}"> <span class="fa fa-trash"></span> </a>
                    </div>
                    </td>
                  </tr>
                  @endfor
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
      {{-- Order list ends --}}
  </div>
</div>
<!-- Container-fluid Ends-->

@endsection

@section('script')

@endsection
