<a href="{{route(\App\Services\Routes\Providers\AdminRoutes::ADMIN_ARTICLE_DELETE, [$id,'locale'=>App::getLocale()])}}" class="btn btn-primary">
    {{ __('admin/article.button.view')}}
</a>

<a href="{{route(\App\Services\Routes\Providers\AdminRoutes::ADMIN_ARTICLE_EDIT,[$id,'locale'=>App::getLocale()])}}" class="btn btn-secondary">
    {{ __('admin/article.button.edit')}}
</a>
