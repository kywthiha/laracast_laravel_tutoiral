<x-master>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h1 class="h1">New Article</h1>
                <form action="/articles" method="POST">
                    @csrf
                    <x-article-manage-form :article="$article" :tags="$tags"/>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</x-master>

