<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Article extends Model
{
    use Searchable;
    protected $fillable = ['title','body','except','user_id'];


    public function author(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function tags(){
        return $this->belongsToMany(Tag::class)->withTimestamps();
    }

    public function comments(){
        return $this->hasMany(Comment::class);
    }

    public function tagsname(){
        return $this->tags->pluck('name')->unique();
    }

    public function toSearchableArray()
    {
        $array = $this->toArray();
        return array('title' => $array['title'],'body' => $array['body']);
    }



}
