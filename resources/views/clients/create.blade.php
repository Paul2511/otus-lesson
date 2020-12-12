@extends("layouts.base")
@section("title")
Create Client
@endsection
@section("content")
	<h2>Create Client</h2>
	<form method="post" action="{{route('client.create')}}">
		@csrf
		@include("includes.client_field", ["client" => new App\Models\Client(), 'edit' => false])
	</form>
@endsection
