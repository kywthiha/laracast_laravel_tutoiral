<?php

namespace App\Http\Controllers;

use App\Article;
use App\Http\Requests\ArticleRequest;
use App\Repositories\ArticleRepository;
use App\Repositories\TagRepository;
use App\Services\ArticleService;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
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
        $paginate = 5;
        if(request('tag')){
            $articles = $this->articleRepository->findByTagId(request('tag'),$paginate);
        }
        elseif(request('user')){
            $articles = $this->articleRepository->findByUserId(request('user'),$paginate);
        }
        else {
            $articles = $this->articleRepository->all($paginate);
        }
        return view('articles.index', compact('articles'));
    }


    public function search(){
        $articles = $this->articleRepository->search(request()->query('query'))->paginate(5);
        $articles->load('tags','author');
        return view('articles.index',compact('articles'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View
     */
    public function create()
    {
        $article = new Article();
        $tags = (new TagRepository())->all();
        return view('articles.create',compact('tags','article'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ArticleRequest $request
     * @return RedirectResponse|Redirector
     */
    public function store(ArticleRequest $request)
    {
        $article = $this->articleService->create($request);
        return redirect(route('articles.show',compact('article')));
    }

    /**
     * Display the specified resource.
     *
     * @param Article $article
     * @return Factory|View
     */
    public function show(Article $article)
    {
        return view('articles.show', compact('article'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Article $article
     * @return Factory|View
     */
    public function edit(Article $article)
    {
        $tags = (new TagRepository())->all();
        return view('articles.edit',compact('article','tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ArticleRequest $request
     * @param Article $article
     * @return RedirectResponse|Redirector
     */
    public function update(ArticleRequest $request, Article $article)
    {
        $article = $this->articleService->update($request,$article);
        return redirect(route('articles.show',compact('article')));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Article $article
     * @return RedirectResponse
     * @throws Exception
     */
    public function destroy(Article $article)
    {
        $this->articleService->delete($article);
        return redirect(route('articles.index'));
    }


}
