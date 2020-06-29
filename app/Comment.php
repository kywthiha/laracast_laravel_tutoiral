<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['text','article_id','user_id','comment_id'];
    protected $with = ['user','comments'];
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function article(){
        return $this->belongsTo(Article::class);
    }

    public function comments(){
        return $this->hasMany(Comment::class);
    }
}
