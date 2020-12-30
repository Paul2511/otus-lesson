@extends("layouts.base")
@section("title")
Задачи
@endsection
@section("content")
	<h2>Задачи</h2>
	<div class="container">
		<div class="row">
			@foreach($tasks as $task)
				@can("view", $task)
			    <div class="col-sm">
			      <a href="{{route('task.show', ['task' => $task->id])}}">{{$task->name}}</a>
			    </div>
			    <div class="w-100"></div>
			    @endcan
		    @endforeach
	 	 </div>
	</div>
@endsection