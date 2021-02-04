@extends('layouts.main')

@section('title', 'added')

@section('content')
    <h1>{{__('admin/article.title_added') }}</h1>

    {!! Form::open(['url'=>route(\App\Services\Routes\Providers\AdminRoutes::ADMIN_ARTICLE_STORE)]) !!}

    @include('blocks.form.errors')
    @include('admin.articles.blocks.form.navbar')
    @include('admin.articles.blocks.form.fields')

    {{Form::submit( __('admin/article.button.save'), ['class' => 'btn btn-success'])}}

    {!! Form::close() !!}
@endsection
