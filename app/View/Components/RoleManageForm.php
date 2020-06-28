<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class RoleManageForm extends Component
{
    public $role;
    public $abilities;

    /**
     * Create a new component instance.
     *
     * @param $role
     * @param $abilities
     */
    public function __construct($role,$abilities)
    {
        $this->role = $role;
        $this->abilities = $abilities;
        if(old('name'))
            $this->role->name = old('name');
        if(old('abilities'))
            $this->role->abilities = collect(old('abilities'));
        if(old('description'))
            $this->role->description = old('description');
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View|string
     */
    public function render()
    {
        return view('components.role-manage-form');
    }
}
