<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ArticleInputText extends Component
{
    public $name;
    public $label;
    public $description;

    /**
     * Create a new component instance.
     *
     * @param $name
     * @param $label
     * @param $description
     */
    public function __construct($name,$label,$description=null)
    {
        //
        $this->name = $name;
        $this->label = $label;
        $this->description = $description;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.article-input-text');
    }
}
