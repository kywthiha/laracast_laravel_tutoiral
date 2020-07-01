<div class="form-group">
    <label for="{{ $name }}">{{ $label }}</label>
    <select multiple id="tags" class="@error($name) is-invalid @enderror" name="{{ $name }}[]">
        @foreach($items as $item)
            <option
                value="{{ $item->id }}" {{ $exitItems?$exitItems->contains($item->id)?'selected':'':'' }}>{{ $item->name }}</option>
        @endforeach
    </select>
    @error($name)
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

@push('head')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/slim-select/1.26.0/slimselect.min.css" rel="stylesheet"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slim-select/1.26.0/slimselect.min.js"></script>
@endpush
@push('scripts')
    <script>
        new SlimSelect({
            select: '#tags',
            placeholder: 'Select Tags'
        })
    </script>
@endpush
