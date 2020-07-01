<x-master>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h1 class="h1">New Article</h1>
                <div class="row">
                    <div class="col-8">
                        <form action="/articles" method="POST">
                            @csrf
                            <x-article-manage-form :article="$article" :tags="$tags"/>
                            <input type="hidden" id="article_image">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>

                    </div>

                    <div class="col-4">
                        <form id="image_upload" action="{{ route('images.upload') }}">
                            @csrf
                            <div class="form-group" style="text-align: center;">

                                <div id="upload_status">
                                    @error('image')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="custom-file">
                                    <label for="image" style="margin-top: 5px;">
                                        <img class="img-thumbnail" style="opacity: 0.3;cursor:pointer;"
                                             src="https://via.placeholder.com/300"
                                             id="image_preview" alt="image" title="Image Preview" width="300">
                                        <span class="btn btn-sm btn-primary">Choose Image</span>
                                    </label>
                                    <input type="file" class="custom-file-input" accept=".jpeg,.jpg,.gif,.png"
                                           name="image" id="image">
                                    <button class="btn btn-primary" type="submit">Upload</button>

                                </div>
                            </div>

                            @push('scripts')
                                <script src="{{ asset('js/image_upload.js') }}"></script>
                            @endpush
                        </form>
                    </div>

                </div>


            </div>
        </div>
    </div>
</x-master>

