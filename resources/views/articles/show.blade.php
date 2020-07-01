<x-master>
    <div class="container">
        <div class="card" style="margin-bottom: 10px;">
            <div class="card-body">
                <div class="card-title">
                    <h3><a href="/articles/{{ $article->id }}">{{ ucwords($article->title) }}</a></h3>
                    <p>
                        @foreach($article->tags as $tag)
                            <a href="{{ route("articles.index",['tag'=>$tag]) }}"
                               class="badge badge-pill badge-primary">{{ $tag->name }}</a>
                        @endforeach
                    </p>
                </div>
                <div class="card-text">
                    <p class="text-black-50"> {{ $article->except }}</p>
                    <p class="text-black-50"> {{ $article->body }}</p>
                </div>
                <div class="row">

                    <x-article-edit-button class="card-link" style="margin-right: 30px;" :article="$article"/>

                    <x-article-delete-button class="card-link" :article="$article"/>

                </div>
                <div class="card my-4">
                    <h5 class="card-header">Leave a Comment:</h5>
                    <div class="card-body">
                        <form id="comments_create_form">
                            <div class="form-group">
                                <textarea name="text" class="form-control" rows="3"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
                <div id="comments" article_id="{{ $article->id }}">
                </div>

            </div>
            <div class="card-footer">
                <span>Posted by <span class="text-primary">{{ $article->author->name }}</span></span>
            </div>
        </div>
    </div>
    @push('scripts')
        <script src="{{asset('js/comments.js')}}"></script>
    @endpush
</x-master>

