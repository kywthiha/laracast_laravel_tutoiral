<div>
    <x-article-input-text label="Title" name="title" :description="$article->title"/>
    <x-article-input-select label="Tags" name="tags" :exitItems="$article->tags" :items="$tags"/>
    <x-article-input-textarea label="Body" name="body" :description="$article->body"/>
    <x-article-input-textarea label="Except" name="except" :description="$article->except"/>

</div>
