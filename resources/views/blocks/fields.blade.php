<div class="form-group">
    <label for="InputEmail">@lang('auth.enter_email')</label>
    <input type="email" class="form-control" id="InputEmail" aria-describedby="emailHelp" placeholder="Enter email">
</div>
<div class="form-group">
    <label for="InputPassword">@lang('auth.enter_password')</label>
    <input type="password" class="form-control" id="InputPassword" placeholder="Password">
</div>
<div class="form-group">
    <label for="InputName">@lang('auth.enter_first_name')</label>
    <input type="text" id="InputName">
</div>
<div class="form-group">
    <label for="InputLastName">@lang('auth.enter_last_name')</label>
    <input type="text" id="InputLastName">
</div>
<div class="form-group">
    <label>@lang('auth.enter_role')</label>
    <label>User<input type="radio" value="manager" name="role"></label>
</div>
<button type="submit" class="btn btn-primary">@lang('messages.submit')</button>
