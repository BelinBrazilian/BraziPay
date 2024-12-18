<x-modal.base.default-modal id="kt_modal_update_plan" title="Update Plan" size="mw-650px">
    <x-slot name="body">
        {{-- Form --}}
        <form id="kt_modal_update_plan_form" class="form" wire:submit.prevent="submit">
            {{-- Code --}}
            <x-form.input-text
                label="Code"
                model="code"
                name="code"
                placeholder="Enter plan code"
                required
            />

            {{-- Name --}}
            <x-form.input-text
                label="Name"
                model="name"
                name="name"
                placeholder="Enter plan name"
                required
            />

            {{-- Interval --}}
            <x-form.select
                label="Interval"
                model="interval"
                name="interval"
                :options="['daily' => 'Daily', 'weekly' => 'Weekly', 'monthly' => 'Monthly', 'yearly' => 'Yearly']"
                placeholder="Select interval"
                required
            />

            {{-- Interval Count --}}
            <x-form.input-number
                label="Interval Count"
                model="interval_count"
                name="interval_count"
                placeholder="Enter interval count"
                required
            />

            {{-- Billing Trigger Type --}}
            <x-form.input-text
                label="Billing Trigger Type"
                model="billing_trigger_type"
                name="billing_trigger_type"
                placeholder="Enter billing trigger type"
                required
            />

            {{-- Billing Trigger Day --}}
            <x-form.input-number
                label="Billing Trigger Day"
                model="billing_trigger_day"
                name="billing_trigger_day"
                placeholder="Enter billing trigger day"
                required
            />

            {{-- Billing Cycles --}}
            <x-form.input-number
                label="Billing Cycles"
                model="billing_cycles"
                name="billing_cycles"
                placeholder="Enter billing cycles"
            />

            {{-- Description --}}
            <x-form.textarea
                label="Description"
                model="description"
                name="description"
                placeholder="Enter plan description"
            />

            {{-- Installments --}}
            <x-form.input-number
                label="Installments"
                model="installments"
                name="installments"
                placeholder="Enter number of installments"
            />

            {{-- Invoice Split --}}
            <x-form.input-number
                label="Invoice Split"
                model="invoice_split"
                name="invoice_split"
                placeholder="Enter invoice split"
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

            {{-- Metadata --}}
            <x-form.textarea
                label="Metadata (JSON)"
                model="metadata"
                name="metadata"
                placeholder="Enter metadata in JSON format"
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
        const modal = document.querySelector('#kt_modal_update_plan');

        modal.addEventListener('show.bs.modal', (e) => {
            const planId = e.relatedTarget.getAttribute('data-plan-id');
            Livewire.dispatch('modal.show.plan', [planId]);
        });
    </script>
@endpush
