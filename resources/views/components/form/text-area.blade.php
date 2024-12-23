<div class="fv-row mb-7">
    <label class="{{ $required ? 'required' : '' }} fw-semibold fs-6 mb-2">{{ $label }}</label>
    <textarea
        wire:model.live="{{ $model }}"
        name="{{ $name }}"
        class="form-control form-control-solid"
        placeholder="{{ $placeholder ?? '' }}"
    ></textarea>
    @error($model) <span class="text-danger">{{ $message }}</span> @enderror
</div>
