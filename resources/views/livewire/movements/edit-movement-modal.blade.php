<x-modal.base.default-modal id="kt_modal_update_movement" title="Update Movement" size="mw-650px">
    <x-slot name="body">
        {{-- Form --}}
        <form id="kt_modal_update_movement_form" class="form" wire:submit.prevent="submit">
            {{-- Bill --}}
            <x-form.select
                label="Bill"
                model="bill_id"
                name="bill_id"
                :options="$bills"
                placeholder="Select a bill"
                required
            />

            {{-- Amount --}}
            <x-form.input-number
                label="Amount"
                model="amount"
                name="amount"
                placeholder="Enter movement amount"
                required
            />

            {{-- Movement Type --}}
            <x-form.select
                label="Movement Type"
                model="movement_type"
                name="movement_type"
                :options="['credit' => 'Credit', 'debit' => 'Debit']"
                placeholder="Select movement type"
                required
            />

            {{-- Origin --}}
            <x-form.input-text
                label="Origin"
                model="origin"
                name="origin"
                placeholder="Enter movement origin"
                required
            />

            {{-- Description --}}
            <x-form.textarea
                label="Description"
                model="description"
                name="description"
                placeholder="Enter movement description"
            />

            {{-- Actions --}}
            <div class="text-center pt-15">
                <button type="reset" class="btn btn-light me-3" data-bs-dismiss="modal">Discard</button>
                <button type="submit" class="btn btn-primary">
                    <span class="indicator-label" wire:loading.remove>Submit</span>
                    <span class="indicator-progress" wire:loading>Please wait...
                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                    </span>
                </button>
            </div>
        </form>
    </x-slot>
</x-modal.base.default-modal>

@push('scripts')
    <script>
        const modal = document.querySelector('#kt_modal_update_movement');

        modal.addEventListener('show.bs.modal', (e) => {
            const movementId = e.relatedTarget.getAttribute('data-movement-id');
            Livewire.dispatch('modal.show.movement', [movementId]);
        });
    </script>
@endpush
