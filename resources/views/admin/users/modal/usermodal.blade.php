<!-- User Modal -->
<div class="modal fade" id="userEditorModal" tabindex="-1" role="dialog" aria-labelledby="userModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="userModalLabel">{{ __('messages.users.index.create') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class=”col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2″>
                    @include('admin.users.form.createorupdate')
                </div>
            </div>
        </div>