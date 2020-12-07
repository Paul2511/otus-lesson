<script src="{{asset('assets/js/libs/jquery-3.1.1.min.js')}}"></script>
<link href="{{asset('plugins/flatpickr/flatpickr.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('plugins/flatpickr/custom-flatpickr.css')}}" rel="stylesheet" type="text/css">
<script src="{{asset('plugins/flatpickr/flatpickr.js')}}"></script>
<script src="{{asset('plugins/select2/select2.min.js')}}"></script>
<script src="{{asset('plugins/select2/custom-select2.js')}}"></script>
<script src="{{asset('plugins/bootstrap-select/bootstrap-select.min.js')}}"></script>
<link rel="stylesheet" type="text/css" href="{{asset('plugins/select2/select2.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('plugins/bootstrap-select/bootstrap-select.min.css')}}">
<script src="https://npmcdn.com/flatpickr@4.5.2/dist/l10n/ru.js"></script>

<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 layout-top-spacing">

    <div class="user-profile layout-spacing">
        <div class="widget-content widget-content-area">
            <div class="d-flex justify-content-between">
                <h4 class="">@lang('filter.name')</h4>
            </div>

            @if(!empty($date) && $date == 'date_single')
                @include('elements.date', array('id'=>'date'))
            @endif

            @if(!empty($date) && $date == 'date_period')
                @include('elements.date-range', array('id'=>'date_period'))
            @endif

            @if(!empty($date) && $date == 'date_month')
                @include('elements.date-month', array('id'=>'date_month'))
            @endif




        </div>
    </div>
</div>

