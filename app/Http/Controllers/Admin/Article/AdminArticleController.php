<?php

namespace App\Http\Controllers\Admin\Article;

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\Article\Request\AdminArticleStoreRequest;
use App\Http\Controllers\Admin\Article\Request\AdminUserRequest;
use App\Models\Article;
use App\Policies\Permission;
use App\Services\Articles\ArticleService;
use App\Services\Routes\Providers\AdminRoutes;
use Illuminate\Support\Facades\App;


class AdminArticleController extends AdminController
{
    private ArticleService $articleService;

    public function __construct(
        ArticleService $articleService
    )
    {
        $this->articleService = $articleService;
    }

    public function index()
    {
        $this->authorize(Permission::VIEW_ANY, Article::class);

        \View::share([
            'articles' => $this->articleService->searchArticle(self::DEFAULT_MODELS_PER_PAGE)
        ]);

        return view(AdminRoutes::ADMIN_ARTICLE_INDEX);
    }


    public function create()
    {
        $this->authorize(Permission::CREATE, Article::class);

        return view('admin.articles.create');
    }


    public function store(AdminArticleStoreRequest $request)
    {
        $this->authorize(Permission::UPDATE, Article::class);

        $this->articleService->createArticle($request->all());

        return redirect()->route(AdminRoutes::ADMIN_ARTICLE_INDEX)
            ->with('success', __('admin/article.event.add'));
    }

    public function show(Article $article)
    {
        return view(AdminRoutes::ADMIN_ARTICLE_SHOW, [
            'article' => $article
        ]);
    }


    public function edit(Article $article)
    {
        $this->authorize(Permission::UPDATE, Article::class);

        return view(AdminRoutes::ADMIN_ARTICLE_EDIT, [
            'article' => $article
        ]);
    }


    public function update(AdminArticleStoreRequest $request, Article $article)
    {
        $this->authorize(Permission::UPDATE, Article::class);

        $this->articleService->updateArticle($article, $request->all());

        return redirect()->route(AdminRoutes::ADMIN_ARTICLE_INDEX, ['locale' => App::getLocale()])
            ->with('success', __('admin/article.event.update'));
    }

    public function destroy(Article $article)
    {
        $this->authorize(Permission::DELETE, Article::class);

        $this->articleService->deleteArticle($article);

        return redirect()->route(AdminRoutes::ADMIN_ARTICLE_INDEX, ['locale' => App::getLocale()])
            ->with('success', __('admin/article.event.delete'));
    }
}
