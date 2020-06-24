<x-master>
    <div id="wrapper">
        <div id="page" class="container">
            <div id="content">
                @can('create',\App\Article::class)
                    <div style="margin:20px;">
                        <form action="{{ route("articles.create") }}" method="GET">
                            <button class="btn btn-success">Add Post</button>
                        </form>
                    </div>
                @endcan
                <x-article-list :articles="$articles"/>
            </div>
        </div>
    </div>
</x-master>



