<x-modal.base.default-modal id="kt_modal_add_product" title="Add Product" size="mw-650px">
    <x-slot name="body">
        {{-- Form --}}
        <form id="kt_modal_add_product_form" class="form" wire:submit.prevent="submit">
            {{-- Scroll --}}
            <div class="d-flex flex-column scroll-y px-5 px-lg-10" id="kt_modal_add_product_scroll" data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-max-height="auto"
                 data-kt-scroll-dependencies="#kt_modal_add_product_header" data-kt-scroll-wrappers="#kt_modal_add_product_scroll" data-kt-scroll-offset="300px">

                {{-- Name --}}
                <x-form.input-text
                    label="Name"
                    model="name"
                    name="name"
                    placeholder="Enter product name"
                    required
                />

                {{-- Code --}}
                <x-form.input-text
                    label="Code"
                    model="code"
                    name="code"
                    placeholder="Enter product code"
                />

                {{-- Unit --}}
                <x-form.input-text
                    label="Unit"
                    model="unit"
                    name="unit"
                    placeholder="Enter unit"
                />

                {{-- Status --}}
                <x-form.select
                    label="Status"
                    model="status"
                    name="status"
                    :options="[
                        '' => 'Select status',
                        'active' => 'Active',
                        'inactive' => 'Inactive',
                        'deleted' => 'Deleted'
                    ]"
                    required
                />

                {{-- Description --}}
                <x-form.textarea
                    label="Description"
                    model="description"
                    name="description"
                    placeholder="Enter description"
                />

                {{-- Invoice --}}
                <x-form.select
                    label="Invoice"
                    model="invoice"
                    name="invoice"
                    :options="[
                        '' => 'Select invoice type',
                        'always' => 'Always',
                        'on_demand' => 'On Demand'
                    ]"
                    required
                />

                {{-- Metadata --}}
                <x-form.textarea
                    label="Metadata (JSON)"
                    model="metadata"
                    name="metadata"
                    placeholder="Enter metadata in JSON format"
                />

                {{-- Pricing Schema --}}
                <div class="fv-row mb-7">
                    <h5 class="fw-bold">Pricing Schema</h5>
                    <x-form.input-text
                        label="Price"
                        model="pricingSchema.price"
                        name="pricingSchema.price"
                        type="number"
                        step="0.01"
                        placeholder="Enter base price"
                    />
                    <x-form.input-text
                        label="Minimum Price"
                        model="pricingSchema.minimum_price"
                        name="pricingSchema.minimum_price"
                        type="number"
                        step="0.01"
                        placeholder="Enter minimum price"
                    />
                    <x-form.input-text
                        label="Schema Type"
                        model="pricingSchema.schema_type"
                        name="pricingSchema.schema_type"
                        placeholder="Enter schema type (e.g., 'flat')"
                    />
                </div>

            </div>

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
        </form>
    </x-slot>
</x-modal.base.default-modal>
