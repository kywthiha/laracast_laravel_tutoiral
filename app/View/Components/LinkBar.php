<?php

namespace App\View\Components;



use Illuminate\View\Component;

class LinkBar extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.nav-bar.link-bar');
    }

    public function isActive($name){
        return request()->is("$name*") ;
    }
}
