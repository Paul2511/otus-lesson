<a href="{{route(\App\Services\Routes\Providers\AdminRoutes::ADMIN_ARTICLE_DELETE, $id)}}" class="btn btn-primary">
    {{ __('admin/article.button.view')}}
</a>

<a href="{{route(\App\Services\Routes\Providers\AdminRoutes::ADMIN_ARTICLE_EDIT, $id)}}" class="btn btn-secondary">
    {{ __('admin/article.button.edit')}}
</a>
