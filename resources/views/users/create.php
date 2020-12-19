@extends("layouts.base")
@section("title")
Регистрация
@endsection
@section("content")
	<h2>Регистрация</h2>
	<form method="post" action="{{route('user.create')}}">
		@csrf
		@include("includes.fields",["user" => new App\Models\User(), 'register' => true])
	</form>
@endsection
