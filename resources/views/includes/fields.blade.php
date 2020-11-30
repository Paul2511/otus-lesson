@include("includes.validate")
<div class="form-group">
    <label for="InputEmail">Email</label>
    <input name="email" type="email" id="InputEmail" aria-describedby="emailHelp" placeholder="Enter email" value="{{old('email', $user->email)}}">
    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
</div>
<div class="form-group">
    <label for="InputPassword">Пароль</label>
    <input name="password" type="password" id="InputPassword" value="{{old('password', $user->password)}}" placeholder="Password">
</div>
  <div class="form-group">
    <label for="InputName">Имя</label>
    <input name="name" type="text" id="InputName" placeholder="Заполните имя" value="{{old('name', $user->name)}}">
  </div>
  <div class="form-group">
  <label for="InputLastName">Фамилия</label>
  <input name="last_name" type="text" id="InputLastName" placeholder="Заполните фамилию" value="{{old('last_name', $user->name)}}">
  </div>
  <div class="form-group">
  <label for="InputPatronimycName">Отчество</label>
  <input name="patronymic" type="text" id="InputPatronimycName" placeholder="Заполните отчество" value="{{old('patronymic', $user->patronymic)}}">
  </div>
  @if($register)
    <div class="form-group">
      <label>Должность</label>
      <label>Менеджер <input type="radio" value="manager" name="role"></label>
      <label>Программист <input type="radio" value="developer" name="role"></label>
    </div>
  @endif
 <button type="submit" class="btn btn-primary">Submit</button>
