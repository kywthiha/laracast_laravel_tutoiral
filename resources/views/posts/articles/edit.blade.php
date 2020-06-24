<x-master>
    <div id="wrapper">
        <div id="page" class="container">
            <h1 class="h1">New Article</h1>
            <form action="/articles/{{$article->id}}" method="POST">
                @method('PUT')
                @csrf
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{  $article->title }}">
                    @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="tags">Tags</label>
                    <select multiple id="tags" class="@error('tags') is-invalid @enderror" name="tags[]">

                        @foreach($tags as $tag)
                            <option
                                value="{{ $tag->id }}" {{ $article->tags->contains($tag)?'selected':'' }}>{{ $tag->name }}</option>
                        @endforeach
                    </select>
                    @error('tags')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror

                </div>
                <div class="form-group">
                    <label for="body">Body</label>
                    <textarea class="form-control @error('body') is-invalid @enderror" name="body" id="body" rows="3">{{ $article->body }}</textarea>
                    @error('body')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="except">Except</label>
                    <textarea class="form-control @error('except') is-invalid @enderror" name="except" id="except" rows="3">{{ $article->except }}</textarea>
                    @error('except')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</x-master>

