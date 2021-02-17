@extends('layouts.main')

@section('title', $article->meta_title)

@section('content')
    <h1>{{ $article->name }}</h1>
    <div class="btn-group mb-3">
        <a class="btn btn-info" href="{{route(\App\Services\Routes\Providers\AdminRoutes::ADMIN_ARTICLE_INDEX ,['locale'=>App::getLocale()])}}" role="button">{{ __('admin/article.button.return') }}</a>
        <a class="btn btn-success" href="{{route(\App\Services\Routes\Providers\AdminRoutes::ADMIN_ARTICLE_EDIT,[$article->id,'locale'=>App::getLocale()])}}" role="button">{{ __('admin/article.button.edit') }}</a>
    </div>
    <div>
        {{$article->description}}
    </div>

@endsection
