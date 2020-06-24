<?php

namespace App\Http\Controllers;

use App\Article;
use App\Http\Requests\ArticleRequest;
use App\Repositories\ArticleRepository;
use App\Services\ArticleService;
use App\Tag;
use App\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ArticleController extends Controller
{
    /**
     * @var ArticleService
     */
    private $articleService;
    /**
     * @var ArticleRepository
     */
    private $articleRepository;

    public function __construct(ArticleService $articleService,ArticleRepository $articleRepository)
    {
        $this->middleware('auth');
        $this->authorizeResource(Article::class, 'article');
        $this->articleService = $articleService;
        $this->articleRepository = $articleRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     */
    public function index()
    {
        if(request('tag')){
            $article = $this->articleRepository->findByTagId(request('tag'))->paginate(5);
        }
        elseif(request('user')){
            $article = $this->articleRepository->findByUserId(request('user'))->paginate(5);
        }
        else {
            $article = $this->articleRepository->all()->paginate(5);
        }
        return view('posts.articles.index', ['articles'=>$article]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View
     */
    public function create()
    {
        return view('posts.articles.create',['tags'=>Tag::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(ArticleRequest $request)
    {
        $article = new Article();
        $article->title = $request->title;
        $article->body = $request->body;
        $article->tags = $request->tags;
        $article->except = $request->except;
        $article = $this->articleService->create($article,Auth::id());
        return redirect($article->path());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Article  $article
     * @return Factory|View
     */
    public function show(Article $article)
    {
        return view('posts.articles.show', ['article'=>$article]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Article $article
     * @return Factory|View
     */
    public function edit(Article $article)
    {
        return view('posts.articles.edit',['article'=>$article,'tags'=>Tag::all()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param \App\Article $article
     * @return RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(ArticleRequest $request, Article $article)
    {
        $article->title = $request->title;
        $article->body = $request->body;
        $article->except = $request->except;
        $article->tags = $request->tags;
        $article = $this->articleService->update($article,Auth::id());
        return redirect($article->path());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Article $article
     * @return RedirectResponse
     * @throws \Exception
     */
    public function destroy(Article $article)
    {
        $this->articleService->delete($article->id);
        return back();
    }


}
