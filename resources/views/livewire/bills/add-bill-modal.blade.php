<x-modal.base.default-modal id="kt_modal_add_bill" title="Add Bill" size="mw-650px">
    <x-slot name="body">
        <form id="kt_modal_add_bill_form" class="form" wire:submit.prevent="submit" enctype="multipart/form-data">
            <input type="hidden" wire:model.live="bill_id" name="bill_id" />

            <div class="d-flex flex-column scroll-y px-5 px-lg-10" id="kt_modal_add_bill_scroll"
                 data-kt-scroll="true" data-kt-scroll-activate="true"
                 data-kt-scroll-max-height="auto"
                 data-kt-scroll-dependencies="#kt_modal_add_bill_header"
                 data-kt-scroll-wrappers="#kt_modal_add_bill_scroll"
                 data-kt-scroll-offset="300px">

                {{-- Customer --}}
                <x-form.select
                    label="Customer"
                    model="customer_id"
                    name="customer_id"
                    placeholder="Select a customer"
                    :options="$customers->pluck('name', 'id')->toArray()"
                    required
                />

                {{-- Payment Method --}}
                <x-form.select
                    label="Payment Method"
                    model="payment_method_id"
                    name="payment_method_id"
                    placeholder="Select a payment method"
                    :options="$payment_methods->pluck('name', 'id')->toArray()"
                    required
                />

                {{-- Code --}}
                <x-form.input-text
                    label="Code"
                    model="code"
                    name="code"
                    placeholder="Enter bill code"
                    required
                />

                {{-- Billing Date --}}
                <x-form.input-text
                    label="Billing Date"
                    model="billing_at"
                    name="billing_at"
                    type="date"
                    required
                />

                {{-- Due Date --}}
                <x-form.input-text
                    label="Due Date"
                    model="due_at"
                    name="due_at"
                    type="date"
                    required
                />

                {{-- Brand TID --}}
                <x-form.input-text
                    label="Brand TID"
                    model="brand_tid"
                    name="brand_tid"
                    placeholder="Enter brand TID"
                />
            </div>
        </form>
    </x-slot>

    <x-slot name="footer">
        <button type="reset" class="btn btn-light me-3" data-bs-dismiss="modal" aria-label="Close" wire:loading.attr="disabled">
            Discard
        </button>
        <button type="submit" form="kt_modal_add_bill_form" class="btn btn-primary" data-kt-users-modal-action="submit">
            <span class="indicator-label" wire:loading.remove>Submit</span>
            <span class="indicator-progress" wire:loading wire:target="submit">
                Please wait...
                <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
            </span>
        </button>
    </x-slot>
</x-modal.base.default-modal>
