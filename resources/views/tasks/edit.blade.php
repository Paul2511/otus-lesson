@extends("layouts.base")
@section("title")
Task - edit
@endsection
@section("content")
	<h2>Edit Task</h2>
	<form method="post" action="{{route('task.edit', ['task' => $task->id])}}">
		@method("PUT")
		@csrf
		@include("includes.task_fields",["task" => $task, 'edit' => true])
	</form>
	<form action="{{route('task.destroy', ['task' => $task->id])}}">@method("DELETE") @csrf<input type="submit" value="Delete"></form>
@endsection