<?php


namespace App\Services;


use App\User;
use Illuminate\Support\Facades\Auth;

class UserService
{
    public function assignRole(User $user,array $roles=null)
    {
        $user->user_id = Auth::id();
        $user->save();
        $user->roles()->sync($roles);
        return $user;
    }
}
