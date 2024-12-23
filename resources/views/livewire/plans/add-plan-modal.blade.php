<x-modal.base.default-modal id="kt_modal_add_plan" title="Add Plan" size="mw-650px">
    <x-slot name="body">
        {{-- Form --}}
        <form id="kt_modal_add_plan_form" class="form" wire:submit.prevent="submit">
            {{-- Scroll Wrapper --}}
            <div class="d-flex flex-column scroll-y px-5 px-lg-10" id="kt_modal_add_plan_scroll" data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-max-height="auto"
                 data-kt-scroll-dependencies="#kt_modal_add_plan_header" data-kt-scroll-wrappers="#kt_modal_add_plan_scroll" data-kt-scroll-offset="300px">

                {{-- Plan Code --}}
                <x-form.input-text
                    label="Code"
                    model="code"
                    name="code"
                    placeholder="Enter plan code"
                    required
                />

                {{-- Plan Name --}}
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
                    :options="['' => 'Select interval', 'daily' => 'Daily', 'weekly' => 'Weekly', 'monthly' => 'Monthly', 'yearly' => 'Yearly']"
                    required
                />

                {{-- Interval Count --}}
                <x-form.input-text
                    label="Interval Count"
                    model="interval_count"
                    name="interval_count"
                    type="number"
                    placeholder="Enter interval count"
                    required
                />

                {{-- Description --}}
                <x-form.textarea
                    label="Description"
                    model="description"
                    name="description"
                    placeholder="Enter plan description"
                />

                {{-- Installments --}}
                <x-form.input-text
                    label="Installments"
                    model="installments"
                    name="installments"
                    type="number"
                    placeholder="Enter number of installments"
                />

                {{-- Invoice Split --}}
                <x-form.input-text
                    label="Invoice Split"
                    model="invoice_split"
                    name="invoice_split"
                    type="number"
                    placeholder="Enter invoice split (if applicable)"
                />

                {{-- Status --}}
                <x-form.select
                    label="Status"
                    model="status"
                    name="status"
                    :options="['' => 'Select status', 'active' => 'Active', 'inactive' => 'Inactive']"
                    required
                />

                {{-- Metadata --}}
                <x-form.textarea
                    label="Metadata (JSON)"
                    model="metadata"
                    name="metadata"
                    placeholder="Enter metadata in JSON format"
                />

            </div>

            {{-- Actions --}}
            <div class="text-center pt-15">
                <button type="reset" class="btn btn-light me-3" data-bs-dismiss="modal" aria-label="Close" wire:loading.attr="disabled">Discard</button>
                <button type="submit" class="btn btn-primary">
                    <span class="indicator-label" wire:loading.remove>Submit</span>
                    <span class="indicator-progress" wire:loading wire:target="submit">
                        Please wait...
                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                    </span>
                </button>
            </div>
        </form>
    </x-slot>
</x-modal.base.default-modal>
