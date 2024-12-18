<div class="fv-row mb-7">
    <label class="fs-6 fw-semibold form-label mb-2">
        <span class="{{ $required ? 'required' : '' }}">{{ $label }}</span>
        @if($tooltip)
            <span class="ms-2" data-bs-toggle="popover" data-bs-trigger="hover" data-bs-html="true" data-bs-content="{{ $tooltip }}">
                {!! getIcon('information', 'fs-7') !!}
            </span>
        @endif
    </label>
    <input
        type="{{ $type }}"
        name="{{ $name }}"
        wire:model.live="{{ $model }}"
        class="form-control form-control-solid"
        placeholder="{{ $placeholder }}"
        @if($required) required @endif
    />
    @error($model)
    <span class="text-danger">{{ $message }}</span>
    @enderror
</div>
