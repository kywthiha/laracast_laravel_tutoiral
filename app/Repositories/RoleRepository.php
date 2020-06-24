<?php


namespace App\Repositories;


use App\Ability;
use App\Role;

class RoleRepository
{
    public function all()
    {
        return Role::with([])->latest()->get();
    }

    public function withAll(){
        return Role::with(['users','abilities','created_users'])->latest()->get();
    }

    public function allAbility(){
        return Ability::with([])->latest()->get();
    }

}
