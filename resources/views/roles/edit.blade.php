@extends('posts.layouts.app')
@section('link')

@endsection
@section('content')
    <div id="wrapper">
        <div id="page" class="container">
            <h4 class="h4">Edit Role</h4>
            <form action="{{route('roles.update',$role)}}" method="POST">
                @method('PUT')
                @csrf
                <div class="form-group">
                    <label for="name">Role Name</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                           value="{{  $role->name }}">
                    @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <div class="row is-invalid">
                        @foreach($abilities as $ability)
                            <div class="form-check" style="margin-top: 10px;margin-left: 20px;">
                                <input class="form-check-input" name="abilities[]" id="{{ $ability->id }}" value="{{ $ability->id }}" type="checkbox" {{ $role->abilities->contains($ability)?'checked':'' }}>
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
                              id="description" rows="3">{{ $role->description }}</textarea>
                    @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
@endsection
@section('script')
    <script type="text/javascript">
        $(document).ready(function () {

        });
    </script>
@endsection
