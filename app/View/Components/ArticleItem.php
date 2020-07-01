<?php

namespace App\View\Components;

use Illuminate\Support\Carbon;
use Illuminate\View\Component;

class ArticleItem extends Component
{
    public $article;

    /**
     * Create a new component instance.
     *
     * @param $article
     */
    public function __construct($article)
    {
        $this->article = $article;
    }

    public function postedDate(){
        return $this->article->created_at->toFormattedDateString();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.article-item');
    }
}
