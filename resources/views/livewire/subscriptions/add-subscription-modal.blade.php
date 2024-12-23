<x-modal.base.default-modal id="kt_modal_add_subscription" title="Add Subscription" size="mw-650px">
    <x-slot name="body">
        {{-- Form --}}
        <form id="kt_modal_add_subscription_form" class="form" wire:submit.prevent="submit">
            {{-- Scroll --}}
            <div class="d-flex flex-column scroll-y px-5 px-lg-10" id="kt_modal_add_subscription_scroll" data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-max-height="auto"
                 data-kt-scroll-dependencies="#kt_modal_add_subscription_header" data-kt-scroll-wrappers="#kt_modal_add_subscription_scroll" data-kt-scroll-offset="300px">

                {{-- Plan --}}
                <x-form.select
                    label="Plan"
                    model="plan_id"
                    name="plan_id"
                    :options="$plans->pluck('name', 'id')->prepend('Select a Plan', '')"
                    required
                />

                {{-- Customer --}}
                <x-form.select
                    label="Customer"
                    model="customer_id"
                    name="customer_id"
                    :options="$customers->pluck('name', 'id')->prepend('Select a Customer', '')"
                    required
                />

                {{-- Payment Method --}}
                <x-form.select
                    label="Payment Method"
                    model="payment_method_id"
                    name="payment_method_id"
                    :options="$payment_methods->pluck('public_name', 'id')->prepend('Select a Payment Method', '')"
                    required
                />

                {{-- Code --}}
                <x-form.input-text
                    label="Code"
                    model="code"
                    name="code"
                    placeholder="Enter subscription code"
                />

                {{-- Start Date --}}
                <x-form.input-text
                    label="Start Date"
                    model="start_at"
                    name="start_at"
                    type="date"
                    required
                />

                {{-- Installments --}}
                <x-form.input-text
                    label="Installments"
                    model="installments"
                    name="installments"
                    type="number"
                    placeholder="Enter number of installments"
                />

                {{-- Billing Trigger Type --}}
                <x-form.input-text
                    label="Billing Trigger Type"
                    model="billing_trigger_type"
                    name="billing_trigger_type"
                    placeholder="Enter billing trigger type"
                />

                {{-- Invoice Split --}}
                <x-form.input-text
                    label="Invoice Split"
                    model="invoice_split"
                    name="invoice_split"
                    type="number"
                    placeholder="Enter invoice split (if applicable)"
                />

                {{-- Metadata --}}
                <x-form.textarea
                    label="Metadata (JSON)"
                    model="metadata"
                    name="metadata"
                    placeholder="Enter metadata in JSON format"
                />

            </div>
            {{-- End Scroll --}}

            {{-- Actions --}}
            <div class="text-center pt-15">
                <button type="reset" class="btn btn-light me-3" data-bs-dismiss="modal" aria-label="Close" wire:loading.attr="disabled">Discard</button>
                <button type="submit" class="btn btn-primary">
                    <span class="indicator-label" wire:loading.remove>Submit</span>
                    <span class="indicator-progress" wire:loading>Please wait...
                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                    </span>
                </button>
            </div>
            {{-- End Actions --}}
        </form>
    </x-slot>
</x-modal.base.default-modal>
