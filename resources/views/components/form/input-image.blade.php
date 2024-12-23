<div class="fv-row mb-7">
    <label class="fw-semibold fs-6 mb-2">{{ $label }}</label>
    <div class="image-input image-input-outline image-input-placeholder {{ $currentImage || $model ? '' : 'image-input-empty' }}" data-kt-image-input="true">
        <div class="image-input-wrapper w-125px h-125px" style="background-image: url('{{ $currentImage ?? $model->temporaryUrl() ?? $placeholder }}');"></div>
        <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" title="Change avatar">
            {!! getIcon('pencil','fs-7') !!}
            <input type="file" wire:model="{{ $model }}" name="{{ $name }}" accept="{{ implode(',', $allowedFileTypes) }}"/>
            <input type="hidden" name="{{ $name }}_remove"/>
        </label>
        <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="cancel" title="Cancel avatar">
            {!! getIcon('cross','fs-2') !!}
        </span>
        <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="remove" title="Remove avatar">
            {!! getIcon('cross','fs-2') !!}
        </span>
    </div>
    <div class="form-text">Allowed file types: {{ implode(', ', $allowedFileTypes) }}</div>
    @error($model)
    <span class="text-danger">{{ $message }}</span> @enderror
</div>
