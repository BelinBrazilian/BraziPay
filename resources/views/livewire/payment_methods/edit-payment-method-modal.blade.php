<x-modal.base.default-modal id="kt_modal_update_payment_method" title="Update Payment Method" size="mw-650px">
    <x-slot name="body">
        {{-- Form --}}
        <form id="kt_modal_update_payment_method_form" class="form" wire:submit.prevent="submit">
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
                :options="['credit_card' => 'Credit Card', 'debit_card' => 'Debit Card', 'bank_transfer' => 'Bank Transfer']"
                placeholder="Select type"
                required
            />

            {{-- Status --}}
            <x-form.select
                label="Status"
                model="status"
                name="status"
                :options="['active' => 'Active', 'inactive' => 'Inactive']"
                placeholder="Select status"
                required
            />

            {{-- Settings --}}
            <x-form.textarea
                label="Settings (JSON)"
                model="settings"
                name="settings"
                placeholder="Enter settings in JSON format"
            />

            {{-- Set Subscription on Success --}}
            <x-form.toggle
                label="Set Subscription on Success"
                model="set_subscription_on_success"
                name="set_subscription_on_success"
            />

            {{-- Allow as Alternative --}}
            <x-form.toggle
                label="Allow as Alternative"
                model="allow_as_alternative"
                name="allow_as_alternative"
            />

            {{-- Maximum Attempts --}}
            <x-form.input-number
                label="Maximum Attempts"
                model="maximum_attempts"
                name="maximum_attempts"
                placeholder="Enter maximum attempts"
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
        const modal = document.querySelector('#kt_modal_update_payment_method');

        modal.addEventListener('show.bs.modal', (e) => {
            const paymentMethodId = e.relatedTarget.getAttribute('data-payment-method-id');
            Livewire.dispatch('modal.show.payment_method', [paymentMethodId]);
        });
    </script>
@endpush
