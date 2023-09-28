<div class="mb-3 col-md-6">
    <label for="features" class="form-label"> Màu sản phẩm </label>
    <select name="colors[]" class="form-select form-select-lg mb-3" id="colors" multiple
        aria-label="Large select example">
        @foreach ($colors as $key => $color)
            <option @if (old('colors')) {{ in_array($color->id, old('colors')) ? 'selected' : '' }} @endif
                value="{{ $color->id }}"> {{ $color->name }}</option>
        @endforeach
    </select>
    @error('colors')
        <small class="text-danger">
            {{ $message }}
        </small>
    @enderror
</div>


<div class="mb-3 col-md-6">
    <label for="sizes" class="form-label"> Size sản phẩm </label>
    <select name="sizes[]" class="form-select form-select-lg mb-3" id="sizes" multiple
        aria-label="Large select example">
        @foreach ($sizes as $key => $size)
            <option @if (old('sizes')) {{ in_array($size->id, old('sizes')) ? 'selected' : '' }} @endif
                value="{{ $size->id }}"> {{ $size->name }}</option>
        @endforeach
    </select>
    @error('sizes')
        <small class="text-danger">
            {{ $message }}
        </small>
    @enderror
</div>
