@extends("layouts.base")
@section("title")
    @lang('profile.profile')
@endsection
@section("content")
    <h2>@lang('profile.profile')</h2>
    <article>
        <p>@lang('profile.first_name') : User</p>
        <p>@lang('profile.last_name'): User</p>
        <p>@lang('profile.email') : user@mail.com</p>
        <p>@lang('profile.role') : User</p>
    </article>
@endsection
