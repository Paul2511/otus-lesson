@extends('layouts.index')
@section('content')
    <p>Привет {{Auth::user()->name}}</p>
@endsection
