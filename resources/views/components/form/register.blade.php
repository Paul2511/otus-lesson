<form>
    <div class="form-group">
        <label for="loginInputName">@lang("auth.enter_name")</label>
        <input type="text"
               class="form-control"
               id="loginInputName"
        >
    </div>

    <div class="form-group">
        <label for="loginInputEmail">@lang("auth.enter_email")</label>
        <input type="email"
               class="form-control"
               id="loginInputEmail"
               aria-describedby="emailHelp">

        <small id="emailHelp" class="form-text text-muted">
            @lang("auth.email_caption")
        </small>
    </div>

    <div class="form-group">
        <label for="loginInputPassword">@lang("auth.enter_password")</label>
        <input type="password" class="form-control" id="loginInputPassword">
    </div>

    <div class="form-group">
        <label for="loginInputPassword2">@lang("auth.confirm_password")</label>
        <input type="password" class="form-control" id="loginInputPassword2">
    </div>

    <button type="submit" class="btn mt-3 py-2 px-4 btn-primary">@lang("messages.do_register")</button>
</form>