@extends("layouts.base")
@section("title")
    @lang('messages.register')
@endsection
@section("content")
    <h2>@lang('messages.register')</h2>
    <form method="post">
        @csrf
        @include("blocks.fields")
    </form>
@endsection
