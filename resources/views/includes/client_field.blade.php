<div class="form-group">
    <label for="InputName">Name</label>
    <input name="name" type="text" id="InputName" value="{{old('name', $client->name)}}">
</div>
<div class="form-group">
    <label for="InputName">Last Name</label>
    <input name="last_name" type="text" id="LastName" value="{{old('last_name', $client->last_name)}}">
</div>
<div class="form-group">
    <label for="InputName">Patronimyc</label>
    <input name="patronymic" type="text" id="Patronimyc" value="{{old('patronymic', $client->patronymic)}}">
</div>addres
<div class="form-group">
    <label for="Email">Email</label>
    <input name="email" type="email" id="Email" value="{{old('email', $client->email)}}">
</div>
<div class="form-group">
    <label for="Addres">Addres</label>
    <input name="addres" type="text" id="Addres" value="{{old('addres', $client->addres)}}">
</div>
@include("includes.validate")
<div class="form-group">
    <label for="Phone">Addres</label>
    <input name="phone" type="text" id="Phone" value="{{old('phone', $client->phone)}}">
</div>
<div class="form-group">
    <label for="Wishes">Wishes</label>
    <input name="wishes" type="text" id="Wishes" value="{{old('wishes', $client->wishes)}}">
</div>
<div class="form-group">
    <label for="Complaints">Complaints</label>
    <input name="complaints" type="text" id="Complaints" value="{{old('complaints', $client->complaints)}}">
 </div>
 <div class="form-group">
    <label for="Selected_service">Selected service</label>
    <textarea id="Selected_service" name="selected_service">{{old('selected_service', $client->description)}}</textarea>>
</div>
 <select name="interest_status">
 	<option value="dont know about service">dont know about service</option>
 	<option value="know about service">know about service</option>
 	<option value="have interest">have interest</option>
 	<option value="pay some service">pay some service</option>
 	<option value="dislike our service">dislike our service</option>
 </select>
@if(!$edit)
    <input type="hidden" name="user_id" value="{{Auth::id()}}">
@endif
<button type="submit" class="btn btn-primary">Submit</button>