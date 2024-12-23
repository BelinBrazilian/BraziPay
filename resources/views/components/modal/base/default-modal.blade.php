<div class="modal fade" id="{{ $id }}" tabindex="-1" aria-hidden="true" wire:ignore.self>
    <div class="modal-dialog modal-dialog-centered {{ $size ?? 'mw-650px' }}">
        <div class="modal-content">
            {{-- Modal Header --}}
            <div class="modal-header">
                @isset($header)
                    {{-- Slot Customizado para Header --}}
                    {{ $header }}
                @else
                    {{-- Header Padrão --}}
                    <h2 class="fw-bold">{{ $title }}</h2>
                    <div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal" aria-label="Close">
                        {!! getIcon('cross', 'fs-1') !!}
                    </div>
                @endisset
            </div>
            {{-- Modal Body --}}
            <div class="modal-body px-5 my-7">
                {{ $slot }}
            </div>
            {{-- Modal Footer --}}
            @if (isset($footer))
                {{-- Slot Customizado para Footer --}}
                <div class="modal-footer text-center pt-15">
                    {{ $footer }}
                </div>
            @elseif ($showFooter ?? true)
                {{-- Footer Padrão --}}
                <div class="modal-footer text-center pt-15">
                    <button type="button" class="btn btn-light me-3" data-bs-dismiss="modal" wire:loading.attr="disabled">{{ $cancelText ?? 'Discard' }}</button>
                    <button type="submit" class="btn btn-primary">
                        <span class="indicator-label" wire:loading.remove>{{ $submitText ?? 'Submit' }}</span>
                        <span class="indicator-progress" wire:loading>
                            Please wait...
                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                        </span>
                    </button>
                </div>
            @endif
        </div>
    </div>
</div>
