<x-modal.base.default-modal id="kt_modal_update_transaction" title="Update Transaction" size="mw-650px">
    <x-slot name="body">
        {{-- Form --}}
        <form id="kt_modal_update_transaction_form" class="form" wire:submit.prevent="submit">
            {{-- Charge ID --}}
            <x-form.input-text
                label="Charge ID"
                model="charge_id"
                name="charge_id"
                placeholder="Enter the charge ID"
                required
            />

            {{-- Payment Method --}}
            <x-form.select
                label="Payment Method"
                model="payment_method_id"
                name="payment_method_id"
                :options="$payment_methods"
                placeholder="Select a payment method"
                required
            />

            {{-- Amount --}}
            <x-form.input-number
                label="Amount"
                model="amount"
                name="amount"
                placeholder="Enter transaction amount"
                step="0.01"
                required
            />

            {{-- Paid At --}}
            <x-form.input-datetime
                label="Paid At"
                model="paid_at"
                name="paid_at"
                required
            />

            {{-- Comments --}}
            <x-form.textarea
                label="Comments"
                model="comments"
                name="comments"
                placeholder="Add any comments (optional)"
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
        const modal = document.querySelector('#kt_modal_update_transaction');

        modal.addEventListener('show.bs.modal', (e) => {
            const transactionId = e.relatedTarget.getAttribute('data-transaction-id');
            Livewire.dispatch('modal.show.transaction', [transactionId]);
        });
    </script>
@endpush
