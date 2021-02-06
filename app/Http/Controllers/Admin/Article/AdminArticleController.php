<?php

namespace App\Http\Controllers\Admin\Article;

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\Article\Request\AdminArticleStoreRequest;
use App\Models\Article;
use App\Services\Articles\ArticleService;
use App\Services\Articles\Repositories\EloquentArticleRepository;
use App\Services\Routes\Providers\AdminRoutes;


class AdminArticleController extends AdminController
{
    private EloquentArticleRepository $eloquentArticleRepository;
    private ArticleService $articleService;

    public function __construct(
        ArticleService $articleService,
        EloquentArticleRepository $eloquentArticleRepository
    )
    {
        $this->articleService = $articleService;
        $this->eloquentArticleRepository = $eloquentArticleRepository;
    }

    public function index()
    {

        \View::share([
            'articles' => $this->articleService->searchArticle(self::DEFAULT_MODELS_PER_PAGE)
        ]);

        return view(AdminRoutes::ADMIN_ARTICLE_INDEX);
    }


    public function create()
    {

        return view('admin.articles.create');
    }


    public function store(AdminArticleStoreRequest $request)
    {

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
        return view(AdminRoutes::ADMIN_ARTICLE_EDIT, [
            'article' => $article
        ]);
    }


    public function update(AdminArticleStoreRequest $request,  Article $article)
    {

        $this->articleService->updateArticle($article, $request->all());

        return redirect()->route(AdminRoutes::ADMIN_ARTICLE_INDEX)
            ->with('success', __('admin/article.event.update'));
    }

    public function destroy(Article $article)
    {
        $this->articleService->deleteArticle($article);

        return redirect()->route(AdminRoutes::ADMIN_ARTICLE_INDEX)
            ->with('success', __('admin/article.event.delete'));
    }
}
