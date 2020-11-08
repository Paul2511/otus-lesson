@extends('layouts.master')

@section('title', __('Dashboard'))

@section('style')
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/prism.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/date-picker.css')}}">
@endsection

@section('breadcrumb-title', __('pages/dashboard.dashboard'))
@section('breadcrumb-item')
<li class="breadcrumb-item active"> {{__('pages/dashboard.dashboard')}}</li>
@endsection

@section('body')
<!-- Container-fluid starts-->
<div class="container-fluid">
  <div class="row starter-main">
    {{-- Widgets row starts --}}
    <div class="col-sm-6 col-xl-3 col-lg-6">
      <div class="card o-hidden">
        <div class="bg-info b-r-4 card-body">
          <div class="media static-top-widget">
            <div class="align-self-center text-center"><i data-feather="file"></i></div>
            <div class="media-body"><span class="m-0">{{__('pages/dashboard.orders') }}</span>
              <h4 class="mb-0 counter">4</h4><i class="icon-bg" data-feather="file"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-sm-6 col-xl-3 col-lg-6">
      <div class="card o-hidden">
        <div class="bg-secondary b-r-4 card-body">
          <div class="media static-top-widget">
            <div class="align-self-center text-center"><i data-feather="book"></i></div>
            <div class="media-body"><span class="m-0">{{__('pages/dashboard.documents') }}</span>
              <h4 class="mb-0 counter">12</h4><i class="icon-bg" data-feather="book"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-sm-6 col-xl-3 col-lg-6">
      <div class="card o-hidden">
        <div class="bg-primary b-r-4 card-body">
          <div class="media static-top-widget">
            <div class="align-self-center text-center"><i data-feather="message-square"></i></div>
            <div class="media-body"><span class="m-0">{{__('pages/dashboard.messages') }}</span>
              <h4 class="mb-0 counter">8</h4><i class="icon-bg" data-feather="message-square"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-sm-6 col-xl-3 col-lg-6">
      <div class="card o-hidden">
        <div class="bg-primary b-r-4 card-body">
          <div class="media static-top-widget">
            <div class="align-self-center text-center"><i data-feather="users"></i></div>
            <div class="media-body"><span class="m-0">{{__('pages/dashboard.users') }}</span>
              <h4 class="mb-0 counter">1</h4><i class="icon-bg" data-feather="users"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
    {{-- Widgets row ends --}}
    {{-- Orders card starts --}}
    <div class="col-xl-6 xl-100">
      <div class="card">
        <div class="card-header">
          <h5>{{ Str::upper(__('pages/dashboard.orders')) }}</h5>
          <div class="card-header-right">
            <ul class="list-unstyled card-option">
              <li><i class="icofont icofont-simple-left"></i></li>
              <li><i class="icofont icofont-maximize full-card"></i></li>
              <li><i class="icofont icofont-minus minimize-card"></i></li>
              <li><i class="icofont icofont-refresh reload-card"></i></li>
              <li><i class="icofont icofont-error close-card"></i></li>
            </ul>
          </div>
        </div>
        <div class="card-body">
          <div class="user-status table-responsive">
            <table class="table table-bordernone">
              <thead>
                <tr>
                  <th scope="col">{{ Str::upper(__('pages/dashboard.details')) }}</th>
                  <th scope="col">{{ Str::upper(__('pages/dashboard.quantity')) }}</th>
                  <th scope="col">{{ Str::upper(__('pages/dashboard.status')) }}</th>
                </tr>
              </thead>
              <tbody>
                @for ($i = 0; $i < 4; $i++)
                <tr>
                  <td>{{ __('pages/dashboard.lorem') }}</td>
                  <td class="digits text-center">1</td>
                  <td class="font-primary">{{ __('pages/dashboard.pending') }}</td>
                </tr>
                @endfor
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    {{-- Orders card ends --}}
    {{-- Calendar widget starts --}}
    <div class="col-xl-6 xl-100">
      <div class="card">
        <div class="cal-date-widget card-body">
          <div class="row">
            <div class="col-xl-6 col-xs-12 col-md-6 col-sm-6">
              <div class="cal-info text-center">
                <h2>28</h2>
                <div class="d-inline-block mt-2"><span class="b-r-dark pr-3">November</span><span class="pl-3">2020</span></div>
                <p class="mt-4 f-16 text-muted">{{ __('pages/dashboard.estimated')}}</p>
              </div>
            </div>
            <div class="col-xl-6 col-xs-12 col-md-6 col-sm-6">
              <div class="cal-datepicker">
                <div class="datepicker-here float-sm-right" data-language="en"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    {{-- Calendar widget ends--}}

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
