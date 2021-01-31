<?php
$months = [
    'Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep',
    'Oct','Nov','Dec'
];
?>
<div class="col-4">
    <label for="{{ $id }}">@lang('filter.DateName')</label>
<select class="form-control basic" id="{{$id}}">
    @for ($i = 1; $i < 12; $i++)
        @if ($i == 1)
            <option selected="selected">{{__('filter.' .$months[$i-1])}}</option>
        @else
            <option>{{__('filter.' .$months[$i-1])}}</option>
        @endif
    @endfor

</select>
</div>
<script>
    var ss = $("{{$id}}").select2({
        tags: true,
    });
</script>
