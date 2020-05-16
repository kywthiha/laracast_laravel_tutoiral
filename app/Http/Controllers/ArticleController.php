<?php

namespace App\Http\Controllers;

use App\Article;
use App\Tag;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ArticleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     */
    public function index()
    {
        if(request('tag')){
            $article = Tag::findOrFail(request('tag'))->articles()->with(['author','tags'])->paginate();
        }
        else {
            $article = Article::with(['author','tags'])->latest()->paginate(5);
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
    public function store(Request $request)
    {
        $this->validateArticle($request);
        $article = new Article();
        $article->user_id = Auth::id();
        $article->title = $request->title;
        $article->body = $request->body;
        $article->except = $request->except;
        $article->save();
        $article->tags()->attach($request->tags);

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
    public function update(Request $request, Article $article)
    {
        $this->validateArticle($request);
        $article->title = $request->title;
        $article->body = $request->body;
        $article->except = $request->except;
        $article->save();
        $article->tags()->sync($request->tags);

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
        $article->delete();
        return back();
    }

    protected function validateArticle(Request $request){
        return   $request->validate([
            'title'=>'required',
            'body'=>'required',
            'except'=>'required',
            'tags'=>'exists:tags,id'
        ]);
    }
}
