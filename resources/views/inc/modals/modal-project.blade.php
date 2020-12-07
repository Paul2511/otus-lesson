<!-- Modal -->
<div class="modal fade" id="NewProjectModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">@lang('users.newProject')</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="@lang('users.Close')">
                    <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                         fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                         stroke-linejoin="round" class="feather feather-x">
                        <line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group mb-4">
                        <label for="project">@lang('users.Project')</label>
                        <select  class="placeholder js-states form-control" id="project">
                        </select>
                    </div>
                    <div class="form-group mb-4">
                        <label for="statuses">@lang('users.Statuses')</label>
                        <select class="form-control " id="statuses">
                            <option selected="selected">orange</option>
                            <option>white</option>
                            <option>purple</option>
                        </select>
                    </div>
                    <div class="form-group mb-4">
                        <label for="bases">@lang('users.Bases')</label>
                        <select class="form-control " id="bases">
                            <option selected="selected">orange</option>
                            <option>white</option>
                            <option>purple</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> @lang('users.Cancel')</button>
                <button type="button" class="btn btn-primary">@lang('users.Save')</button>
            </div>
        </div>
    </div>
</div>

<script>

        function setProjects() {

            let projects = '';
            $.each(queues, function (index, element) {
                $('#project').append('<option value=' + index + '>' + index + " "+ element.name_display + '</option>');
            });
            $(".placeholder").select2({
                placeholder: '@lang('users.Choose')',
                allowClear: true
            });
        }
</script>

