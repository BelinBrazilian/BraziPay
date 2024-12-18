<div {{ $attributes->merge(['class' => 'notice d-flex bg-light-warning rounded border-warning border border-dashed p-6']) }}>
    {!! getIcon('information', 'fs-2tx text-warning me-4') !!}
    <div class="d-flex flex-stack flex-grow-1">
        <div class="fw-semibold text-gray-700">
            {{ $slot }}
        </div>
    </div>
</div>
