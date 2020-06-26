<?php

namespace App\View\Components;

use Illuminate\View\Component;

class RoleInputCheckBox extends Component
{
    public $label;
    public $name;
    public $items;
    public $exitItems;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($label,$name,$items,$exitItems=null)
    {

        $this->label = $label;
        $this->name = $name;
        $this->items = $items;
        $this->exitItems = $exitItems;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.role-input-check-box');
    }
}
