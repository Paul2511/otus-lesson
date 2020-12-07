
<select class="form-control basic" id="{{$id}}">
    @for ($i = 1; $i < 12; $i++)
        @if ($i == 1)
            <option selected="selected">Январь </option>
        @else
            <option>Январь</option>
        @endif
    @endfor

</select>
<script>
    var ss = $("{{$id}}").select2({
        tags: true,
    });
</script>
