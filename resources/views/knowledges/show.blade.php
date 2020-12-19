@extends("layouts.base")
@section("title")
Knowledges - detail
@endsection
@section("content")
	<h2>{{$knowl->name}}</h2>
	<div class="container">
		<article><p>{{$knowl->description}}</p></article>
		<section>
			<p>
				{{$knowl->data}}
			</p>
		</section>
	</div>
@endsection