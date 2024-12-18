<div class="fv-row mb-7">
    <label class="{{ $required ? 'required' : '' }} fw-semibold fs-6 mb-2">{{ $label }}</label>
    <select
        class="form-select"
        wire:model.live="{{ $model }}"
        name="{{ $name }}">
        <option value="">{{ $placeholder ?? 'Select an option' }}</option>
        @foreach($options as $value => $text)
            <option value="{{ $value }}">{{ $text }}</option>
        @endforeach
    </select>
    @error($model) <span class="text-danger">{{ $message }}</span> @enderror
</div>
