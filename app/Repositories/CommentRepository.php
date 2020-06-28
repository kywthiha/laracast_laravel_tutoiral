<?php


namespace App\Repositories;


use App\Article;
use App\Tag;
use App\User;


class CommentRepository
{
    public function findByArticle(Article $article)
    {
        return $article->comments;
    }

}
