<div class="fv-row mb-7">
    <label class="d-block fw-semibold fs-6 mb-5">{{ $label }}</label>
    <div class="image-input image-input-outline {{ $value ? '' : 'image-input-empty' }}">
        <div class="image-input-wrapper w-125px h-125px" style="background-image: url({{ $value ?? $placeholder }})"></div>
        <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change">
            {!! getIcon('pencil','fs-7') !!}
            <input type="file" wire:model.live="{{ $model }}" name="{{ $name }}" accept="{{ $accept ?? '.png, .jpg, .jpeg' }}"/>
        </label>
        <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="remove">
            {!! getIcon('cross','fs-2') !!}
        </span>
    </div>
    <div class="form-text">{{ $hint }}</div>
    @error($model) <span class="text-danger">{{ $message }}</span> @enderror
</div>
