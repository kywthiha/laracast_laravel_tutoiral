<div {{ $attributes }}>
    <div class="form-group">
        <label>{{ $label }}</label>
        <div class="form-row is-invalid">
            @foreach($items as $item)
                <div class="form-check">
                    <div style="padding: 5px;">
                        <input class="form-check-input" name="{{$name}}[]" id="{{ $item->id }}" value="{{ $item->id }}"
                               type="checkbox" {{ $exitItems->contains($item->id)?'checked':'' }}>
                        <label
                            class="form-check-label {{ $exitItems->contains($item->id)?'badge badge-secondary':'' }}"
                            for="{{ $item->id }}">
                            {{ $item->name }}
                        </label>
                    </div>
                </div>
            @endforeach
        </div>
        @error('abilities')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>
