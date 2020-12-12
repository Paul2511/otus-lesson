@extends("layouts.base")
@section("title")
Create Knowledge
@endsection
@section("content")
	<h2>Create Knowledge</h2>
	<form method="post" action="{{route('knowledge.create')}}">
		@csrf
		@include("includes.knowledge_field",["knowl" => new App\Models\Knowledge(), 'edit' => false])
	</form>
@endsection
