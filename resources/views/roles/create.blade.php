<x-master>
    <div id="wrapper">
        <div id="page" class="container">
            <h4 class="h4">New Role</h4>
            <form action="{{route('roles.store')}}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Role Name</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                           value="{{  old('name') }}">
                    @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <div class="row is-invalid">
                        @foreach($abilities as $ability)
                            <div class="form-check" style="margin-top: 10px;margin-left: 20px;">
                                <input class="form-check-input" name="abilities[]" id="{{ $ability->id }}" value="{{ $ability->id }}" type="checkbox" {{ in_array($ability->id,old('abilities')?old('abilities'):[])?'checked':''}}>
                                <label class="form-check-label" for="{{ $ability->id }}">
                                    {{ $ability->name }}
                                </label>
                            </div>
                        @endforeach

                    </div>
                    @error('abilities')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea class=" form-control @error('description') is-invalid @enderror" name="description"
                              id="description" rows="3">{{ old('description') }}</textarea>
                    @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</x-master>
