<div class="form-group mb-0" style="margin:5px">
    <div class="col-2">
        <label for="{{ $id }}">Период: </label>
        <input id="{{ $id }}" value=""
               class="form-control form-control-sm flatpickr flatpickr-input active"
               type="text" placeholder="@lang('filter.select_date')"
               readonly="readonly">
    </div>
</div>
<script>
    var f3 = flatpickr(document.getElementById('{{ $id }}'), {
        mode: "range"
    });
</script>
