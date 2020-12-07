@extends("layouts.base")
@section("title")
User - edit
@endsection
@section("content")
	<h2>Регистрация</h2>
	<form method="post" action="{{route('user.edit', ['user' => $user->id])}}">
		@method("PUT")
		@csrf
		@include("includes.fields",["user" => $user, 'register' => false])
	</form>
	<form action="{{route('user.destroy', ['user' => $user->id])}}">@method("DELETE") @csrf<input type="submit" value="Delete"></form>
@endsection
