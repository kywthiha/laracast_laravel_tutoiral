<?php


namespace App\Services;


use App\Article;

class ArticleService
{
    public function create(Article $data,int $user_id)
    {
        $article = new Article();
        $article->user_id = $user_id;
        $article->title = $data->title;
        $article->body = $data->body;
        $article->except = $data->except;
        $article->save();
        $article->tags()->attach($data->tags);
        return $article;
    }

    public function update(Article $data,int $user_id)
    {
        $article = Article::find($data->id);
        $article->user_id = $user_id;
        $article->title = $data->title;
        $article->body = $data->body;
        $article->except = $data->except;
        $article->save();
        $article->tags()->sync($data->tags);
        return $article;
    }

    public function delete(int $id)
    {
        $article = Article::find($id);
        $article->delete();
        return $article;
    }
}
