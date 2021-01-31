<div class="col-4">
    <label for="{{ $id }}">@lang('filter.PeriodName')</label>
    <input id="{{ $id }}" value=""
           class="form-control form-control-sm flatpickr flatpickr-input active"
           type="text" placeholder="@lang('filter.select_date')"
           readonly="readonly">
</div>


<script>
    flatpickr.localize(flatpickr.l10ns.ru);
    var f3 = flatpickr(document.getElementById('{{ $id }}'), {
        mode: "range",
        locale: '{{App::getLocale()}}'
    });
</script>
