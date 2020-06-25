<div class="container-fluid">

    @foreach($articles as $article)
       <x-article-item :article="$article"/>
    @endforeach
    {{ $articles->links() }}
</div>
