@extends("layouts.base")
@section("title")
Login
@endsection
@section("content")
	<h2>Please Login</h2>
	<form active="{{route('user.auth')}}" method="post">
		@csrf
		<div class="form-group">
			<label>Email<input name="email" class="form-control" type="email" placeholder="Email"></label>
		</div>
		<div class="form-group">
			<label>Password<input name="password" class="form-control" type="password" placeholder="password"></label>
		</div>
		<input type="submit" class="btn btn-primary" value="Login">
	</form>
@endsection
