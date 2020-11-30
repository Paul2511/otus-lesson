@include("includes.validate")
<div class="form-group">
    <label for="InputName">Name</label>
    <input name="name" type="text" id="InputName" placeholder="Заполните имя" value="{{old('name', $knowl->name)}}">
 </div>
<div class="form-group">
    <label for="Description">Description</label>
    <textarea id="Description" name="description">{{old('description', $knowl->description)}}</textarea>
</div>
<div class="form-group">
    <label for="Data">Data</label>
    <textarea id="Data" name="data">{{old('data', $knowl->description)}}</textarea>>
</div>
@if(!$edit)
    <input type="hidden" name="user_id" value="{{Auth::id()}}">
@endif
<button type="submit" class="btn btn-primary">Submit</button>