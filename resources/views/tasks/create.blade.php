@extends("layouts.base")
@section("title")
Task - create
@endsection
@section("content")
	<h2>Create Task</h2>
	<form method="post" action="{{route('task.create')}}">
		@csrf
		@include("includes.task_fields",["task" => new App\Models\Task(), 'edit' => false])
	</form>
@endsection