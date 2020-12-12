@extends("layouts.base")
@section("title")
Задача - {{$task->name}}
@endsection
@section("content")
	<section id="task-area">
		<h2>Задача {{$task->name}}</h2>
		<p>{{$task->description}}</p>

		<h3>TODO:</h3>
		<form action="{{route('todo.update')}}" method="post">
		@csrf
		@method("PUT")
			<input type="hidden" name="query_type" value="to_done">
		@foreach($task->todos as $todo)
			@if($todo->status == 0)
				<label>{{$todo->name}}<input name="todo_done[]" type="checkbox" value="{{$todo->id}}"></label>
			@endif
		@endforeach
			<input type="submit" value="Send to done marks">
		</form>
		<h3>Done TODO</h3>
		<form action="{{route('todo.update')}}" method="post">
		@csrf
		@method("PUT")
			<input name="query_type" type="hidden" value="to_work">
		@foreach($task->todos as $todo)
			@if($todo->status == 1)
				<label>{{$todo->name}}<input name="todo_to_work[]" type="checkbox" value="{{$todo->id}}"></label>
			@endif
		@endforeach
			<input type="submit" value="Send to work marks">
		</form>
		<h3>Create Todo:</h3>
		<form action="{{route('todo.store')}}" method="post">
		@csrf
			<input type="hidden" name="task_id" value="{{$task->id}}">
			<input type="hidden" name="status" value="0">
			<input name="name" type="text" value="">
			<input type="submit" value="Create mark">
		</form>
	</section>
	<section id="creator-area">
		<h3>Task creator:</h3>
		{{$task->user->name}} {{$task->user->last_name}}
	</section>
	<section id="workers">
		<h3>Workers:</h3>
		@foreach($task->users as $worker)
		<div>
			{{$worker->name}} {{$worker->last_name}}
		</div>
		@endforeach
	</section>
	<section id="comments-wrapper">
		@foreach($task->comments as $comment)
		<div class="comment">
			<p><b>{{$comment->user->name}} {{$comment->user->last_name}}({{$comment->user->email}})</b></p>
			<p>{{$comment->text}}</p>
		</div>
		@endforeach
		<form action="{{route('comment.store')}}" method="post">
			@csrf
			<input type="hidden" name="user_id" value="{{Auth::id()}}">
			<input type="hidden" name="task_id" value="{{$task->id}}">
			<textarea name="text"></textarea>
			<input type="submit" value="Comment">
		</form>
	</section>
@endsection
