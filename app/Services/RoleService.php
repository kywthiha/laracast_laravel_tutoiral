<?php


namespace App\Services;


use App\Http\Requests\RoleRequest;
use App\Role;
use Illuminate\Support\Facades\Auth;

class RoleService
{
    public function create(RoleRequest $request)
    {
        $role= Role::create([
            'name'=> $request->name,
            'user_id'=> Auth::id(),
            'description'=>$request->description,
        ]);
        $role->abilities()->sync($request->abilities);
        return $role;
    }

    public function update(RoleRequest $request,Role $role)
    {
        $role->update([
            'name'=> $request->name,
            'user_id'=> Auth::id(),
            'description'=>$request->description,
        ]);
        $role->abilities()->sync($request->abilities);
        return $role;
    }

    public function delete(Role $role)
    {
        $role->delete();
        return $role;
    }
}
