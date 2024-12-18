<x-modal.base.default-modal id="kt_modal_update_discount" title="Update Discount" size="mw-650px">
    <x-slot name="body">
        {{-- Form --}}
        <form id="kt_modal_update_discount_form" class="form" wire:submit.prevent="submit">
            {{-- Product Item --}}
            <x-form.select
                label="Product Item"
                model="product_item_id"
                name="product_item_id"
                :options="$product_items"
                placeholder="Select a product item"
                required
            />

            {{-- Discount Type --}}
            <x-form.select
                label="Discount Type"
                model="discount_type"
                name="discount_type"
                :options="['percentage' => 'Percentage', 'amount' => 'Fixed Amount']"
                placeholder="Select a discount type"
                required
            />

            {{-- Percentage --}}
            <x-form.input-number
                label="Percentage"
                model="percentage"
                name="percentage"
                placeholder="Enter discount percentage"
            />

            {{-- Amount --}}
            <x-form.input-number
                label="Amount"
                model="amount"
                name="amount"
                placeholder="Enter fixed amount"
            />

            {{-- Quantity --}}
            <x-form.input-number
                label="Quantity"
                model="quantity"
                name="quantity"
                placeholder="Enter quantity"
            />

            {{-- Cycles --}}
            <x-form.input-number
                label="Cycles"
                model="cycles"
                name="cycles"
                placeholder="Enter number of cycles"
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
        const modal = document.querySelector('#kt_modal_update_discount');

        modal.addEventListener('show.bs.modal', (e) => {
            const discountId = e.relatedTarget.getAttribute('data-discount-id');
            Livewire.dispatch('modal.show.discount', [discountId]);
        });
    </script>
@endpush
