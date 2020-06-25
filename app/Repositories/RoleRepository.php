<?php


namespace App\Repositories;


use App\Ability;
use App\Role;
use Illuminate\Database\Eloquent\Collection;

class RoleRepository
{
    public function all():Collection
    {
        return Role::latest()->get();
    }

    public function withAll():Collection
    {
        return Role::with('users','abilities','created_users')->latest()->get();
    }

    public function allAbility():Collection
    {
        return Ability::latest()->get();
    }

}
