<div class="modal fade" id="add_task" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">@lang('index.create task')</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    @csrf
                    <div class="form-group">
                        <label for="input_title">@lang('form.title')</label>
                        <input type="email" class="form-control" id="input_title" aria-describedby="input_help">
                        <small id="input_help" class="form-text text-muted">Add title column below</small>
                    </div>
                    <div class="form-group">
                        <label for="input_title">@lang('form.description')</label>
                        <input type="email" class="form-control" id="input_title" aria-describedby="input_help">
                        <small id="input_help" class="form-text text-muted">Add description column below</small>
                    </div>
                    <button type="submit" class="btn btn-primary">@lang('button.create')</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('button.close')</button>
            </div>
        </div>
    </div>
</div>
