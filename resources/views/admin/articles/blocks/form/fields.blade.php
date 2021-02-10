<div class="tab-content" id="nav-tabContent">
    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
        <div class="form-group">
            {{Form::label('name', __('admin/article.fields.name'))}}
            {{Form::text("name", $article->name ?? '', ['class' => 'form-control'])}}
        </div>
        <div class="form-group">
            {{Form::label('sort', __('admin/article.fields.sort'))}}
            {{Form::text("sort", $article->sort ?? '', ['class' => 'form-control'])}}
        </div>
        <div class="form-group">
            {{Form::label('slug', __('admin/article.fields.slug'))}}
            {{Form::text("slug", $article->slug ?? '', ['class' => 'form-control'])}}
        </div>
        <div class="form-group">
            {{Form::label('short_description', __('admin/article.fields.short_desc'))}}
            {{Form::TextArea("short_description", $article->short_description ?? '', ['class' => 'form-control'])}}
        </div>
        <div class="form-group">
            {{Form::label('description', __('admin/article.fields.desc'))}}
            {{Form::TextArea("description", $article->description ?? '', ['class' => 'form-control'])}}
        </div>
    </div>
    <div class="tab-pane fade" id="nav-seo" role="tabpanel" aria-labelledby="nav-profile-tab">
        <div class="form-group">
            {{Form::label('meta_title', __('admin/article.fields.meta_title'))}}
            {{Form::text("meta_title", $article->meta_title ?? '', ['class' => 'form-control'])}}
        </div>

        <div class="form-group">
            {{Form::label('meta_description',__('admin/article.fields.meta_desc'))}}
            {{Form::TextArea("meta_description", $article->meta_description ?? '', ['class' => 'form-control'])}}
        </div>
    </div>

</div>
