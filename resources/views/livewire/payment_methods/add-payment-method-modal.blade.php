<x-modal.base.default-modal id="kt_modal_add_payment_method" title="Add Payment Method" size="mw-650px">
    <x-slot name="body">
        <form id="kt_modal_add_payment_method_form" class="form" wire:submit.prevent="submit" enctype="multipart/form-data">
            <input type="hidden" wire:model.live="payment_method_id" name="payment_method_id"/>

            <div class="d-flex flex-column scroll-y px-5 px-lg-10" id="kt_modal_add_payment_method_scroll"
                 data-kt-scroll="true" data-kt-scroll-activate="true"
                 data-kt-scroll-max-height="auto"
                 data-kt-scroll-dependencies="#kt_modal_add_payment_method_header"
                 data-kt-scroll-wrappers="#kt_modal_add_payment_method_scroll"
                 data-kt-scroll-offset="300px">

                {{-- Public Name --}}
                <x-form.input-text
                    label="Public Name"
                    model="public_name"
                    name="public_name"
                    placeholder="Enter public name"
                    required
                />

                {{-- Name --}}
                <x-form.input-text
                    label="Name"
                    model="name"
                    name="name"
                    placeholder="Enter name"
                    required
                />

                {{-- Code --}}
                <x-form.input-text
                    label="Code"
                    model="code"
                    name="code"
                    placeholder="Enter code"
                    required
                />

                {{-- Type --}}
                <x-form.select
                    label="Type"
                    model="type"
                    name="type"
                    placeholder="Select type"
                    :options="[
                        'credit_card' => 'Credit Card',
                        'debit_card' => 'Debit Card',
                        'bank_transfer' => 'Bank Transfer'
                    ]"
                    required
                />

                {{-- Status --}}
                <x-form.select
                    label="Status"
                    model="status"
                    name="status"
                    placeholder="Select status"
                    :options="[
                        'active' => 'Active',
                        'inactive' => 'Inactive'
                    ]"
                    required
                />

                {{-- Settings (JSON) --}}
                <x-form.text-area
                    label="Settings (JSON)"
                    model="settings"
                    name="settings"
                    placeholder="Enter settings in JSON format"
                />

                {{-- Maximum Attempts --}}
                <x-form.input-text
                    label="Maximum Attempts"
                    model="maximum_attempts"
                    name="maximum_attempts"
                    type="number"
                    placeholder="Enter maximum attempts"
                />
            </div>
        </form>
    </x-slot>

    <x-slot name="footer">
        <button type="reset" class="btn btn-light me-3" data-bs-dismiss="modal" aria-label="Close" wire:loading.attr="disabled">Discard</button>
        <button type="submit" form="kt_modal_add_payment_method_form" class="btn btn-primary">
            <span class="indicator-label" wire:loading.remove>Submit</span>
            <span class="indicator-progress" wire:loading wire:target="submit">
                Please wait...
                <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
            </span>
        </button>
    </x-slot>
</x-modal.base.default-modal>
