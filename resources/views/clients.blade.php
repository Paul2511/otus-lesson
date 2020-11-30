@extends("layouts.base")
@section("title")
Clients
@endsection
@section("content")
	<h2>Clients</h2>
	<div class="container">
		<div class="row">
			@foreach($clients as $client)
		    <div class="col-sm">
		      <a href="{{route('client.show', ['client' => $client->id])}}">{{$client->name}}</a>
		    </div>
		    <div class="w-100"></div>
		    @endforeach
	 	 </div>
	</div>
@endsection