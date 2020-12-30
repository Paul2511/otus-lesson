@extends("layouts.base")
@section("title")
Knowledges
@endsection
@section("content")
	<h2>Knowledges</h2>
	<div class="container">
		<div class="row">
			@foreach($knowls as $knowl)
				@can("view", $knowl)
				    <div class="col-sm">
				      <a href="{{route('knowledge.show', ['knowledge' => $knowl->id])}}">{{$knowl->name}}</a>
				    </div>
				    <div class="w-100"></div>
			    @endcan
		    @endforeach
	 	 </div>
	</div>
@endsection