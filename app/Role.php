<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    public function users(){
        return $this->belongsToMany(User::class)->withTimestamps();
    }

    public function abilities(){
        return $this->belongsToMany(Ability::class)->withTimestamps();
    }
    public function created_users(){
        return $this->belongsTo(User::class,'user_id','id','users');
    }

}
