<x-modal.base.default-modal id="kt_modal_add_discount" title="Add Discount" size="mw-650px">
    <x-slot name="body">
        <form id="kt_modal_add_discount_form" class="form" wire:submit.prevent="submit" enctype="multipart/form-data">
            <input type="hidden" wire:model.live="discount_id" name="discount_id"/>

            <div class="d-flex flex-column scroll-y px-5 px-lg-10" id="kt_modal_add_discount_scroll"
                 data-kt-scroll="true" data-kt-scroll-activate="true"
                 data-kt-scroll-max-height="auto"
                 data-kt-scroll-dependencies="#kt_modal_add_discount_header"
                 data-kt-scroll-wrappers="#kt_modal_add_discount_scroll"
                 data-kt-scroll-offset="300px">

                {{-- Product Item --}}
                <x-form.select
                    label="Product Item"
                    model="product_item_id"
                    name="product_item_id"
                    placeholder="Select a product item"
                    :options="$product_items->pluck('name', 'id')->toArray()"
                    required
                />

                {{-- Discount Type --}}
                <x-form.select
                    label="Discount Type"
                    model="discount_type"
                    name="discount_type"
                    placeholder="Select a discount type"
                    :options="['percentage' => 'Percentage', 'amount' => 'Fixed Amount']"
                    required
                />

                {{-- Percentage --}}
                <x-form.input-text
                    label="Percentage"
                    model="percentage"
                    name="percentage"
                    type="number"
                    placeholder="Enter percentage"
                />

                {{-- Amount --}}
                <x-form.input-text
                    label="Amount"
                    model="amount"
                    name="amount"
                    type="number"
                    placeholder="Enter fixed amount"
                />

                {{-- Quantity --}}
                <x-form.input-text
                    label="Quantity"
                    model="quantity"
                    name="quantity"
                    type="number"
                    placeholder="Enter quantity"
                />

                {{-- Cycles --}}
                <x-form.input-text
                    label="Cycles"
                    model="cycles"
                    name="cycles"
                    type="number"
                    placeholder="Enter number of cycles"
                />

            </div>
        </form>
    </x-slot>

    <x-slot name="footer">
        <button type="reset" class="btn btn-light me-3" data-bs-dismiss="modal" aria-label="Close" wire:loading.attr="disabled">Discard</button>
        <button type="submit" form="kt_modal_add_discount_form" class="btn btn-primary">
            <span class="indicator-label" wire:loading.remove>Submit</span>
            <span class="indicator-progress" wire:loading wire:target="submit">
                Please wait...
                <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
            </span>
        </button>
    </x-slot>
</x-modal.base.default-modal>
