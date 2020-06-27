<?php

namespace App\Repositories;


use App\Article;
use Illuminate\Database\Eloquent\Collection;


class CommentRepository
{
    public function findByArticle(Article $article): Collection
    {
        $comments = $article->comments()->whereNull('comment_id')->with('comments')->latest();
        return $comments->get();
    }

}
