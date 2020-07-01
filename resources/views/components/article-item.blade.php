<div {{ $attributes->merge(['class' => 'card mb-4','style'=>"margin-bottom: 10px;"]) }}>
    @isset($article->image)
        <img class="card-img-top" style="object-fit: cover;" height="300" src="{{ Storage::url($article->image->url) }}" alt="Card image cap">
    @endisset
    <div class="card-body">
        <h2 class="card-title"><a href="/articles/{{ $article->id }}">{{ ucwords($article->title) }}</a></h2>
        <p>
            @foreach($article->tags as $tag)
                <a href="{{ route("articles.index",['tag'=>$tag]) }}"
                   class="badge badge-pill badge-primary">{{ $tag->name }}</a>
            @endforeach
        </p>
        <p class="card-text">{{ $article->except }}</p>
        <a href="/articles/{{ $article->id }}" class="btn btn-primary">Read More →</a>
    </div>
    <div class="card-footer text-muted">
        Posted on {{ $postedDate() }} by
        <a href="#">{{ $article->author->name }}</a>
        <div class="row">
            <x-article-edit-button class="card-link" :article="$article" />
            <x-article-delete-button class="card-link" :article="$article"/>
        </div>
    </div>
</div>
