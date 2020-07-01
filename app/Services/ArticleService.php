<?php


namespace App\Services;


use App\Article;
use App\Http\Requests\ArticleRequest;
use Illuminate\Support\Facades\Auth;

class ArticleService
{
    public function create(ArticleRequest $request):Article
    {
        $article = Article::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'body' => $request->body,
            'except' => $request->except
        ]);
        $article->tags()->attach($request->tags);
        if ($request->image) {
            $article->image()->create(['url' => $request->image]);
        }
        return $article;
    }

    public function update(ArticleRequest $request,Article $article):Article
    {
        $article->update([
            'user_Id'=>Auth::id(),
            'title'=>$request->title,
            'body'=>$request->body,
            'except'=>$request->except
        ]);
        $article->tags()->sync($request->tags);
        return $article;
    }

    public function delete(Article $article):Article
    {
        $article->delete();
        return $article;
    }
}
