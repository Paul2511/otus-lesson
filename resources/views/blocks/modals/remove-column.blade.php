<div class="modal fade" id="remove_column" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">@lang('index.remove column')</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @foreach($columns as $column)
                    <form class="remove-column" method="POST" action="{{route('column.destroy', $column->id)}}">
                        @method('DELETE')
                        @csrf
                        <p>{{$column->title}}</p>
                        <button type="submit" class="btn btn-secondary"
                                >@lang('button.remove column')</button>
                    </form>
                @endforeach

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('button.close')</button>
            </div>
        </div>
    </div>
</div>
