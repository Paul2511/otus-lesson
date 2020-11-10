<link href="{{asset('plugins/flatpickr/flatpickr.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('plugins/flatpickr/custom-flatpickr.css')}}" rel="stylesheet" type="text/css">
<script src="{{asset('plugins/flatpickr/flatpickr.js')}}"></script>

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


        </div>
    </div>
</div>

