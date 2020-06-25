<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ArticleManageForm extends Component
{
    public $article;
    public $tags;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($article,$tags)
    {
        $this->article = $article;
        $this->tags = $tags;
        if(old('title')) {
            $this->article->title = old('title');
        }
        if(old('tags'))
            $this->article->tags = collect(old('tags'));
        if(old('body'))
            $this->article->body = old('body');
        if(old('except'))
            $this->article->except = old('except');
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.article-manage-form');
    }
}
