<?php


namespace App\Services;


use App\Http\Requests\ProfileImageUploadRequest;
use App\User;
use Illuminate\Support\Facades\Auth;

class UserService
{
    public function assignRole(User $user, array $roles = null)
    {
        $user->user_id = Auth::id();
        $user->save();
        $user->roles()->sync($roles);
        return $user;
    }

    public function storeProfile(ProfileImageUploadRequest $request)
    {
        $user = Auth::user();

        if($user->image){
            $user->image()->update([
                'url' => $request->image_url,
            ]);
        }else{
            $user->image()->create([
                'url' => $request->image_url,
            ]);
        }

        return Auth::user()->image;
    }
}
