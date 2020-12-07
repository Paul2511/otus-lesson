<div class="form-group mb-0" style="margin:5px">
    <div class="col-2">
        <label for="{{ $id }}">@lang('filter.PeriodName')</label>
        <input id="{{ $id }}" value=""
               class="form-control form-control-sm flatpickr flatpickr-input active"
               type="text" placeholder="@lang('filter.select_date')"
               readonly="readonly">
    </div>
</div>

<script>
    flatpickr.localize(flatpickr.l10ns.ru);
    var f3 = flatpickr(document.getElementById('{{ $id }}'), {
        mode: "range",
        locale: 'ru'
    });
</script>
