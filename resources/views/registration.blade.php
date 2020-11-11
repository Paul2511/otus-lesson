@extends("layouts.base")
@section("title")
Регистрация
@endsection
@section("content")
	<h2>Регистрация</h2>
	<form method="post">
		@csrf
		@include("includes.fields")
	</form>
@endsection
