<?php


namespace App\Services;


use App\Role;

class RoleService
{
    public function create(Role $data,int $user_id)
    {
        $role= new Role();
        $role->name = $data->name;
        $role->description = $data->description;
        $role->user_id = $user_id;
        $role->save();
        $role->abilities()->sync($data->abilities);
        return $role;
    }

    public function update(Role $data,int $user_id)
    {
        $role = Role::find($data->id);
        $role->name = $data->name;
        $role->description = $data->description;
        $role->save();
        $role->abilities()->sync($data->abilities);
        return $role;
    }

    public function delete(int $id)
    {
        $role = Role::find($id);
        $role->delete();
        return $role;
    }
}
