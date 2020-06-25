<?php

namespace App\View\Components;

use Illuminate\View\Component;

class RoleList extends Component
{
    public $roles;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($roles)
    {
        //
        $this->roles = $roles;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.role-list');
    }
}
