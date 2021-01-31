<div class="col-4">
    <label for="{{ $id }}">@lang('filter.Project')</label>
    <select class="form-control basic" id="{{$id}}">

    </select>
</div>
<script>
    jQuery(document).ready(function ($) {
        var queues = [];
        getQueues();
        function getQueues() {
            $.ajax({
                type: 'POST',
                beforeSend: function (xhr) { // Add this line
                    xhr.setRequestHeader('X-CSRF-Token', $('[name="_token"]').val());
                },  // Add this line
                url: '/queues',
                data: {},
                dataType: 'json',
                success: function (respond) {
                    queues = respond.queues;
                    setProjects();
                },
                error: function (jqXHR, textStatus, errorThrown) {

                }
            });
        }

        function setProjects() {

            let projects = '';
            $.each(queues, function (index, element) {
                $('#project').append('<option value=' + index + '>' + index + " " + element.name_display + '</option>');
            });
            $(".placeholder").select2({
                placeholder: '@lang('users.Choose')',
                allowClear: true
            });
        }
    });
</script>
