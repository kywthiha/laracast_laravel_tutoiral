<?php


namespace App\Repositories;


use App\Article;
use App\Tag;
use App\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class ArticleRepository
{
    public function all(int $paginate)
    {
        return Article::with(['author', 'tags'])->latest()->paginate($paginate);
    }

    public function search(string $query=null)
    {
        return Article::search($query);
    }

    public function findByUserId(int $id,int $paginate)
    {
        return User::findOrFail($id)->articles()->with(['author', 'tags'])->latest()->paginate($paginate);
    }

    public function findByTagId(int $tag,int $paginate)
    {
        return Tag::findOrFail($tag)->articles()->with(['author', 'tags'])->latest()->paginate($paginate);
    }
}
