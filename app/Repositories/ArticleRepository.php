<?php


namespace App\Repositories;


use App\Article;
use App\Tag;
use App\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class ArticleRepository
{
    public function all():Builder
    {
        return Article::with(['author', 'tags'])->latest();
    }

    public function findByUserId(int $id):BelongsToMany
    {
        return User::findOrFail($id)->articles()->with(['author', 'tags'])->latest();
    }

    public function findByTagId(int $tag):BelongsToMany
    {
        return Tag::findOrFail($tag)->articles()->with(['author', 'tags'])->latest();
    }
}
