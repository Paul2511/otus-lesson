{!! Form::open(['url'=>route(\App\Services\Routes\Providers\AdminRoutes::ADMIN_ARTICLE_DELETE, $id),'method' => 'DELETE']) !!}
<div class="btn-group-vertical">
    @include('admin.articles.blocks.control',['id'=>$id])

    {{Form::submit( __('admin/article.button.delete'), ['class' => 'btn btn-danger'])}}
</div>
{!! Form::close() !!}
