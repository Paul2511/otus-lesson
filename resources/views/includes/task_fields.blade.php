@include("includes.validate")
<div class="form-group">
    <label for="InputName">Name</label>
    <input name="name" type="text" id="InputName" placeholder="Заполните имя" value="{{old('name', $task->name)}}">
 </div>
<div class="form-group">
    <label for="Description">Description</label>
    <textarea id="Description" name="description">{{old('description', $task->description)}}</textarea>>
</div>
@if($edit)
<div class="form-group">
    <label for="Completed">Completed</label>
    <input name="status" id="Completed" @if($task->status == 1) checked="checked" @endif type="checkbox" value="1">
</div>
@else
    <input type="hidden" name="status" value="0">
    <input type="hidden" name="user_id" value="{{Auth::id()}}">
@endif
<button type="submit" class="btn btn-primary">Submit</button>