@extends('public.layouts.app')

@section('content')
    <section id="search_form" class="p-5">
        <div class="container">
            @include('public.forms.search')
        </div>
    </section>
    @include('public.parts.how-work')
    @include('public.parts.last-news')
    @include('public.parts.countries-list')
@endsection
