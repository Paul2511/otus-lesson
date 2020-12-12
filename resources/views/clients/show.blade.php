@extends("layouts.base")
@section("title")
Client - Detail
@endsection
@section("content")
	<h2>Client {{$client->name}} {{$client->last_name}} {{$client->patronymic}}</h2>
	<article>
		<p>Имя: {{$client->name}}</p>
		<p>Фамилия: {{$client->last_name}}</p>
		<p>Отчество: {{$client->patronymic}}</p>
		<p>Email: {{$client->email}}</p>
		<p>interest status: {{$client->interest_status}}</p>
		<p>addres: {{$client->addres}}</p>
		<p>phone: {{$client->phone}}</p>
		<p>wishes: {{$client->wishes}}</p>
		<p>complaints: {{$client->complaints}}</p>
	</article>
	<section>
		<h3>Selected service</h3>
		selected_service: {{$client->selected_service}}
	</section>
	<hr>
	<p>Client manager {{$client->user->name}}</p>
@endsection
