<x-modal.base.default-modal id="kt_modal_update_permission" title="Update Permission" size="mw-650px">
    <x-slot name="body">
        {{-- Warning Notice --}}
        <x-alert.warning class="mb-9">
            <strong class="me-1">Warning!</strong>
            By editing the permission name, you might break the system permissions functionality. Please ensure you're absolutely certain before proceeding.
        </x-alert.warning>

        {{-- Form --}}
        <form id="kt_modal_update_permission_form" class="form" wire:submit.prevent="submit">
            {{-- Permission Name --}}
            <x-form.input-text
                label="Permission Name"
                model="name"
                name="name"
                placeholder="Enter a permission name"
                required
                tooltip="Permission names are required to be unique."
            />

            {{-- Actions --}}
            <div class="text-center pt-15">
                <button type="reset" class="btn btn-light me-3" data-bs-dismiss="modal" aria-label="Close" wire:loading.attr="disabled">Discard</button>
                <button type="submit" class="btn btn-primary">
                    <span class="indicator-label" wire:loading.remove>Submit</span>
                    <span class="indicator-progress" wire:loading wire:target="submit">
                        Please wait...
                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                    </span>
                </button>
            </div>
        </form>
    </x-slot>
</x-modal.base.default-modal>

@push('scripts')
    <script>
        const modal = document.querySelector('#kt_modal_update_permission');

        modal.addEventListener('show.bs.modal', (e) => {
            Livewire.dispatch('modal.show.permission_name', [e.relatedTarget.getAttribute('data-permission-id')]);
        });
    </script>
@endpush

