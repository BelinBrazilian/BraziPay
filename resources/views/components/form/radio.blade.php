<div class="fv-row mb-7">
    <label class="fw-semibold fs-6 mb-2">{{ $label }}</label>
    @foreach($options as $value => $description)
        <div class="d-flex fv-row {{ isset($descriptions[$value]) ? '' : 'mb-3' }}">
            <div class="form-check form-check-custom form-check-solid">
                <input
                    class="form-check-input {{ isset($descriptions[$value]) ? 'me-3' : '' }}"
                    id="{{ $name . '_' . $value }}"
                    wire:model.live="{{ $model }}"
                    name="{{ $name }}"
                    type="radio"
                    value="{{ $value }}"
                />
                <label class="form-check-label" for="{{ $name . '_' . $value }}">
                    <div class="fw-bold text-gray-800">{{ $description }}</div>
                    @isset($descriptions[$value])
                        <div class="text-gray-600">{{ $descriptions[$value] }}</div>
                    @endisset
                </label>
            </div>
        </div>
        @if(!$loop->last)
            <div class="separator separator-dashed my-5"></div>
        @endif
    @endforeach
    @error($model)
    <span class="text-danger">{{ $message }}</span>
    @enderror
</div>
