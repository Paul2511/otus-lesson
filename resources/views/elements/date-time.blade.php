<div class="col-2">
    <label for="{{ $id }}">@lang('filter.DateTimeName')</label>
    <input id="{{ $id }}" value=""
           class="form-control form-control-sm flatpickr flatpickr-input active"
           type="text" placeholder="@lang('filter.select_date_time')"
           readonly="readonly">
</div>
<script>
    flatpickr.localize(flatpickr.l10ns.ru);
    var f1 = flatpickr(document.getElementById('{{ $id }}'), {
        enableTime: true,
        dateFormat: "Y-m-d H:i",
        locale: 'ru'
    });

</script>
