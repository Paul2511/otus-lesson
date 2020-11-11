<form>
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

    <div class="form-group form-check">
        <input type="checkbox" class="form-check-input" id="loginCheckmark">
        <label class="form-check-label" for="loginCheckmark">@lang("auth.remember_me")</label>
    </div>

    <button type="submit" class="btn btn-lg px-5 btn-primary">@lang("messages.do_login")</button>
</form>