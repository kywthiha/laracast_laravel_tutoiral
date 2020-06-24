<?php


namespace App\Repositories;


use App\Article;
use App\Tag;
use App\User;

class ArticleRepository
{
    public function all()
    {
        return Article::with(['author', 'tags'])->latest();
    }

    public function findByUserId(int $id)
    {
        return User::findOrFail($id)->articles()->with(['author', 'tags'])->latest();
    }

    public function findByTagId(int $tag)
    {
        return Tag::findOrFail($tag)->articles()->with(['author', 'tags'])->latest();
    }
}
