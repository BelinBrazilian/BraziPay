<x-modal.base.default-modal id="kt_modal_update_bill" title="Update Bill" size="mw-650px">
    <x-slot name="body">
        {{-- Form --}}
        <form id="kt_modal_update_bill_form" class="form" wire:submit.prevent="submit">
            {{-- Customer --}}
            <x-form.select
                label="Customer"
                model="customer_id"
                name="customer_id"
                :options="$customers"
                placeholder="Select a customer"
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

            {{-- Billing Date --}}
            <x-form.input-date
                label="Billing Date"
                model="billing_at"
                name="billing_at"
                required
            />

            {{-- Due Date --}}
            <x-form.input-date
                label="Due Date"
                model="due_at"
                name="due_at"
                required
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
