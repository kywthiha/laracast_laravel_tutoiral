<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Ramsey\Collection\Collection;


class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function articles(){
        return $this->hasMany(Article::class);
    }

    public function comments(){
        return $this->hasMany(Comment::class);
    }

    public function tags(){
        return $this->belongsToMany(Tag::class)->withTimestamps();
    }

    public function roles(){
        return $this->belongsToMany(Role::class)->withTimestamps()->with(['abilities']);
    }

    public function assigned_user(){
        return $this->belongsTo(User::class,'user_id','id','users');
    }

    public function getAbilities(){
        return $this->roles->pluck('abilities.*.name')->unique()->flatten();
    }

    public function checkAbilities(array $data){
        return $this->getAbilities()->contains(function ($value,$key) use ($data) {
            return in_array($value,$data?$data:[]);
        });
    }

    public function checkAbility(string $data)
    {
        return $this->getAbilities()->contains($data);
    }


}
