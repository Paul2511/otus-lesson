@extends('layouts.main')

@section('title', 'article')

@section('content')
    <h1>{{ __('admin/article.title') }}</h1>
    <div class="btn-group mb-3">
        <a class="btn btn-success" href="{{route(\App\Services\Routes\Providers\AdminRoutes::ADMIN_ARTICLE_CREATE,['locale'=>App::getLocale()])}}" role="button">{{ __('admin/article.button.add') }}</a>
    </div>
    @include('blocks.form.success')
    <div class="container">
        <div class="row">
            <table class="table">
                @include('admin.articles.blocks.list.header')
                <tbody>
                @each('admin.articles.blocks.list.item', $articles, 'article')
                </tbody>
            </table>
            {{ $articles->links() }}
        </div>
    </div>

@endsection
