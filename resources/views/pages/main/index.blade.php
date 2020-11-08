@extends('layouts.master')

@section('page_content')
<!-- Banner Area Starts -->
@include('pages.main.blocks.banner.index')
<!-- Banner Area End -->

<!-- Search Area Starts -->
@include('pages.main.blocks.search.index')
<!-- Search Area End -->

<!-- Category Area Starts -->
@include('pages.main.blocks.categories.index')
<!-- Category Area End -->

<!-- Premium Adverts Area Starts -->
@include('pages.main.blocks.adverts.index')
<!-- Premium Adverts Area End -->

@include('blocks.subscribe.index')
@endsection
