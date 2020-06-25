<div class="form-group">
    <label for="except"> {{ $label }}</label>
    <textarea class="form-control @error($name) is-invalid @enderror" name="{{ $name }}" id="{{ $name }}"
              rows="3">{{ $description }}</textarea>
    @error($name)
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
