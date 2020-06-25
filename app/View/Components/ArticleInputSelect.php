<?php

namespace App\View\Components;

use Illuminate\Support\Collection;
use Illuminate\View\Component;

class ArticleInputSelect extends Component
{
    public $name;
    public $label;
    public $items;
    public $exitItems;

    /**
     * Create a new component instance.
     *
     * @param $name
     * @param $label
     * @param $items
     * @param null $exitItems
     */
    public function __construct($name, $label, $items, $exitItems=null)
    {
        //
        $this->name = $name;
        $this->label = $label;
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
        return view('components.article-input-select');
    }
}
