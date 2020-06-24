<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ability extends Model
{
    public function roles(){
        return $this->belongsToMany(Role::class)->withTimestamps();
    }
}
