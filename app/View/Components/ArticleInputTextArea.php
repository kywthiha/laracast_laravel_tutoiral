<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ArticleInputTextarea extends Component
{
    /**
     * @var null
     */
    public $description;
    public $label;
    public $name;

    /**
     * Create a new component instance.
     *
     * @param $name
     * @param $label
     * @param null $description
     */
    public function __construct($name,$label,$description = null)
    {
        $this->description = $description;
        $this->label = $label;
        $this->name = $name;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.article-input-textarea');
    }
}
