@extends("layouts.base")
@section("title")
Edit Client
@endsection
@section("content")
	<h2>Edit Client</h2>
	<form method="post" action="{{route('client.edit',['client' => $client])}}">
		@method("PUT")
		@csrf
		@include("includes.client_field", ["client" => $client, 'edit' => true])
	</form>
	<form action="{{route('client.destroy', ['client' => $client->id])}}">@method("DELETE") @csrf<input type="submit" value="Delete"></form>
@endsection
