<div class="fv-row mb-7">
    <label class="fw-semibold fs-6 mb-2">{{ $label }}</label>
    @foreach($options as $value => $text)
        <div class="form-check form-check-custom form-check-solid">
            <input
                class="form-check-input"
                type="checkbox"
                wire:model.live="{{ $model }}"
                value="{{ $value }}"
                id="{{ $name . '_' . $value }}"
            />
            <label class="form-check-label" for="{{ $name . '_' . $value }}">{{ $text }}</label>
        </div>
    @endforeach
    @error($model) <span class="text-danger">{{ $message }}</span> @enderror
</div>
