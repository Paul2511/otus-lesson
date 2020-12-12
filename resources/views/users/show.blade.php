@extends("layouts.base")
@section("title")
Личный кабинет
@endsection
@section("content")
	<h2>Личный кабинет</h2>
	<article>
		<p>Имя: {{$user->name}}</p>
		<p>Фамилия: {{$user->last_name}}</p>
		<p>Отчество: {{$user->patronymic}}</p>
		<p>Email: {{$user->email}}</p>
		<p>Должность: {{$user->role}}</p>
	</article>
@endsection
