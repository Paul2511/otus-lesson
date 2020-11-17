@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col">
            {{ $user['name'] }}
        </div>
    </div>

    @foreach($user['rating'] as $title => $rating)
        <div class="row">
            <div class="col-6">
                {{ $title }}
            </div>
            <div class="col-6">
                {{ $rating }}
            </div>
        </div>
    @endforeach
@endsection
