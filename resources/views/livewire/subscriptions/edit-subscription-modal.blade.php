<x-modal.base.default-modal id="kt_modal_update_subscription" title="Update Subscription" size="mw-650px">
    <x-slot name="body">
        {{-- Form --}}
        <form id="kt_modal_update_subscription_form" class="form" wire:submit.prevent="submit">
            {{-- Plan --}}
            <x-form.select
                label="Plan"
                model="plan_id"
                name="plan_id"
                :options="$plans"
                placeholder="Select a plan"
                required
            />

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

            {{-- Payment Profile --}}
            <x-form.select
                label="Payment Profile"
                model="payment_profile_id"
                name="payment_profile_id"
                :options="$payment_profiles"
                placeholder="Select a payment profile"
            />

            {{-- Code --}}
            <x-form.input-text
                label="Code"
                model="code"
                name="code"
                placeholder="Enter subscription code"
            />

            {{-- Start Date --}}
            <x-form.input-date
                label="Start Date"
                model="start_at"
                name="start_at"
                required
            />

            {{-- Installments --}}
            <x-form.input-number
                label="Installments"
                model="installments"
                name="installments"
                placeholder="Enter the number of installments"
            />

            {{-- Billing Trigger Type --}}
            <x-form.input-text
                label="Billing Trigger Type"
                model="billing_trigger_type"
                name="billing_trigger_type"
                placeholder="Enter the billing trigger type"
            />

            {{-- Billing Trigger Day --}}
            <x-form.input-number
                label="Billing Trigger Day"
                model="billing_trigger_day"
                name="billing_trigger_day"
                placeholder="Enter the billing trigger day"
            />

            {{-- Billing Cycles --}}
            <x-form.input-number
                label="Billing Cycles"
                model="billing_cycles"
                name="billing_cycles"
                placeholder="Enter the billing cycles"
            />

            {{-- Invoice Split --}}
            <x-form.input-number
                label="Invoice Split"
                model="invoice_split"
                name="invoice_split"
                placeholder="Enter the invoice split"
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
        const modal = document.querySelector('#kt_modal_update_subscription');

        modal.addEventListener('show.bs.modal', (e) => {
            const subscriptionId = e.relatedTarget.getAttribute('data-subscription-id');
            Livewire.dispatch('modal.show.subscription', [subscriptionId]);
        });
    </script>
@endpush
