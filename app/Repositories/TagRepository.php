<?php


namespace App\Repositories;


use App\Tag;
use Illuminate\Database\Eloquent\Collection;


class TagRepository
{
    public function all():Collection
    {
    return Tag::all();
    }
}
