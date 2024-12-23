<x-modal.base.default-modal id="kt_modal_update_product" title="Update Product" size="mw-650px">
    <x-slot name="body">
        {{-- Form --}}
        <form id="kt_modal_update_product_form" class="form" wire:submit.prevent="submit">
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
                placeholder="Enter product unit"
            />

            {{-- Status --}}
            <x-form.select
                label="Status"
                model="status"
                name="status"
                :options="['active' => 'Active', 'inactive' => 'Inactive', 'deleted' => 'Deleted']"
                placeholder="Select product status"
                required
            />

            {{-- Invoice --}}
            <x-form.select
                label="Invoice"
                model="invoice"
                name="invoice"
                :options="['always' => 'Always', 'on_demand' => 'On Demand']"
                placeholder="Select invoice type"
                required
            />

            {{-- Description --}}
            <x-form.textarea
                label="Description"
                model="description"
                name="description"
                placeholder="Enter product description"
            />

            {{-- Pricing Schema --}}
            <h5 class="fw-bold mt-5">Pricing Schema</h5>

            {{-- Price --}}
            <x-form.input-number
                label="Base Price"
                model="pricingSchema.price"
                name="pricingSchema.price"
                placeholder="Enter base price"
                required
            />

            {{-- Minimum Price --}}
            <x-form.input-number
                label="Minimum Price"
                model="pricingSchema.minimum_price"
                name="pricingSchema.minimum_price"
                placeholder="Enter minimum price"
            />

            {{-- Schema Type --}}
            <x-form.input-text
                label="Schema Type"
                model="pricingSchema.schema_type"
                name="pricingSchema.schema_type"
                placeholder="Enter schema type (e.g., 'flat')"
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
        const modal = document.querySelector('#kt_modal_update_product');

        modal.addEventListener('show.bs.modal', (e) => {
            const productId = e.relatedTarget.getAttribute('data-product-id');
            Livewire.dispatch('modal.show.product', [productId]);
        });
    </script>
@endpush
