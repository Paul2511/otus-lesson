@extends("layouts.base")
@section("title")
Edit Knowledge
@endsection
@section("content")
	<h2>Edit Knowledge</h2>
	<form method="post" action="{{route('knowledge.edit',['knowledge' => $knowledge->id])}}">
		@csrf
		@method("PUT")
		@include("includes.knowledge_field",["knowl" => $knowl, 'edit' => true])
	</form>
	<form action="{{route('knowledge.destroy', ['knowledge' => $knowledge->id])}}">@method("DELETE") @csrf<input type="submit" value="Delete"></form>
@endsection
