<x-master>
    <div class="container">
        <form action="{{ route('articles.search') }}" method="get">
            <div class="form-row justify-content-center">
                <div class="col-9">
                    <input class="form-control" type="search" id="site-search" name="query"
                           placeholder="Search" aria-label="Search" value="{{ request("query") }}">
                </div>
                <div class="col-1">
                    <button class="btn btn-secondary">
                        <svg class="bi bi-search" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor"
                             xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                  d="M10.442 10.442a1 1 0 0 1 1.415 0l3.85 3.85a1 1 0 0 1-1.414 1.415l-3.85-3.85a1 1 0 0 1 0-1.415z"/>
                            <path fill-rule="evenodd"
                                  d="M6.5 12a5.5 5.5 0 1 0 0-11 5.5 5.5 0 0 0 0 11zM13 6.5a6.5 6.5 0 1 1-13 0 6.5 6.5 0 0 1 13 0z"/>
                        </svg>
                    </button>
                </div>
            </div>
        </form>
        <x-article-add-button/>
        <x-article-list :articles="$articles"/>
    </div>
</x-master>



