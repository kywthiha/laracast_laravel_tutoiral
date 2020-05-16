@extends('posts.layouts.app')

@section('content')
    <div id="wrapper">
        <div id="page" class="container">
            <div id="content">
                <div>
                    <form action="{{ route("articles.create") }}" method="GET">
                        <button class="btn btn-success">Add Post</button>
                    </form>
                </div>
                <div class="container-fluid">

                    @foreach($articles as $article)
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

                                    </div>
                                    <div class="row">
                                        @can('update',$article)
                                            <form class="card-link" action="{{ route("articles.edit",$article) }}">
                                                <button class="btn-xs btn-primary">Edit</button>
                                            </form>
                                        @endcan

                                        @can('delete',$article)
                                            <form class="card-link" action="{{ route("articles.delete",$article) }}" onSubmit="return confirm('Are you sure?')" method="POST">
                                                @method('DELETE')
                                                @csrf
                                                <button class="btn-xs btn-danger">Delete</button>
                                            </form>
                                        @endcan
                                    </div>
                                </div>
                                    <div class="card-footer">
                                        <span>Posted by <span class="text-primary">{{ $article->author->name }}</span></span>
                                    </div>
                            </div>
                    @endforeach
                        {{ $articles->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection

