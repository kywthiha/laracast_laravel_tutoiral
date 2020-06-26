<?php

namespace App\View\Components;

use Illuminate\View\Component;

class RoleEditButton extends Component
{
    public $role;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($role)
    {

        $this->role = $role;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.role-edit-button');
    }
}
