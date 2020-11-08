@extends('layouts.master')

@section('title', Str::ucfirst(__('pages/orders.orders')))

@section('style')
@endsection

@section('breadcrumb-title', __('pages/orders.orders') )
@section('breadcrumb-item')
<li class="breadcrumb-item active">{{ __('pages/orders.orders')}}</li>
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
          <h5>{{ __('pages/orders.ordersList')}}</h5>
        </div>
        <div class="card-block row">
          <div class="col-sm-12 col-lg-12 col-xl-12">
            <div class="table-responsive">
              <table class="table">
                <thead class="table-primary">
                  <tr class="text-center">
                    <th scope="col">#</th>
                    <th scope="col">{{ __('pages/orders.customer')}}</th>
                    <th scope="col">{{ __('pages/orders.name')}}</th>
                    <th scope="col">{{ __('pages/orders.date')}}</th>
                    <th scope="col">{{ __('pages/orders.status')}}</th>
                    <th scope="col">{{ __('pages/orders.action')}}</th>
                  </tr>
                </thead>
                <tbody>
                  @for ($i = 1; $i < 8; $i++)
                  <tr class="text-center">
                    <th scope="row">{{ $i }}</th>
                    <td>{{ __('pages/orders.company')}}</td>
                    <td>{{ __('pages/orders.jd')}}</td>
                    <td>{{ date("d M Y",rand(1862055000,1282055681)) }}</td>
                    <td class="txt-secondary">{{ __('pages/orders.pending')}}</td>
                    <td>
                      <div class="btn-group">
                      <a href="#" class="btn btn-secondary btn-sm" title="{{ __('pages/orders.edit')}}"> <span class="fa fa-pencil"></span> </a>
                      <a href="#" class="btn btn-danger btn-sm" title="{{ __('pages/orders.delete')}}"> <span class="fa fa-trash"></span> </a>
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
