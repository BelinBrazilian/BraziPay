<x-modal.base.default-modal id="kt_modal_add_transaction" title="Add Transaction" size="mw-650px">
    <x-slot name="body">
        {{-- Form --}}
        <form id="kt_modal_add_transaction_form" class="form" wire:submit.prevent="submit">
            {{-- Scroll --}}
            <div class="d-flex flex-column scroll-y px-5 px-lg-10" id="kt_modal_add_transaction_scroll" data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-max-height="auto"
                 data-kt-scroll-dependencies="#kt_modal_add_transaction_header" data-kt-scroll-wrappers="#kt_modal_add_transaction_scroll" data-kt-scroll-offset="300px">

                {{-- Charge ID --}}
                <x-form.input-text
                    label="Charge ID"
                    model="charge_id"
                    name="charge_id"
                    placeholder="Enter charge ID"
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

                {{-- Amount --}}
                <x-form.input-text
                    label="Amount"
                    model="amount"
                    name="amount"
                    type="number"
                    placeholder="Enter transaction amount"
                    step="0.01"
                    required
                />

                {{-- Paid At --}}
                <x-form.input-text
                    label="Paid At"
                    model="paid_at"
                    name="paid_at"
                    type="datetime-local"
                />

                {{-- Comments --}}
                <x-form.textarea
                    label="Comments"
                    model="comments"
                    name="comments"
                    placeholder="Add comments (optional)"
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
