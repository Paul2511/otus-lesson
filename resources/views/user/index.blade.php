@extends("layouts.base")
@section("title")
Работники
@endsection
@section("content")
	<h2>Работники</h2>
	<div class="container">
		<div class="row">
			@foreach($users as $user)
		    <div class="col-sm">
		      <a href="{{route('user.show', ['user' => $user->id])}}">{{$user->name}}</a> -  {{$user->role}}
		    </div>
		    <div class="w-100"></div>
		    @endforeach
	 	 </div>
	</div>
@endsection