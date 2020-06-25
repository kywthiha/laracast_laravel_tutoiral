<?php


namespace App\Services;


use App\Article;
use App\Http\Requests\ArticleRequest;

class ArticleService
{
    public function create(ArticleRequest $request,int $user_id):Article
    {
        $article = Article::create([
            'user_id'=>$user_id,
            'title'=>$request->title,
            'body'=>$request->body,
            'except'=>$request->except
        ]);
        $article->tags()->attach($request->tags);
        return $article;
    }

    public function update(ArticleRequest $request,Article $article,int $user_Id):Article
    {
        $article->update([
            'user_Id'=>$user_Id,
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
