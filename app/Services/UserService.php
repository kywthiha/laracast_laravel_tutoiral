<?php


namespace App\Services;


use App\User;
use Illuminate\Support\Facades\Auth;

class UserService
{
    public function assignRole(User $user,int $assign_user_id,array $roles=null)
    {
        $user->user_id = $assign_user_id;
        $user->save();
        $user->roles()->sync($roles);
        return $user;
    }
}
