<x-modal.base.default-modal id="kt_modal_add_movement" title="Add Movement" size="mw-650px">
    <x-slot name="body">
        <form id="kt_modal_add_movement_form" class="form" wire:submit.prevent="submit" enctype="multipart/form-data">
            <input type="hidden" wire:model.live="movement_id" name="movement_id"/>

            <div class="d-flex flex-column scroll-y px-5 px-lg-10" id="kt_modal_add_movement_scroll"
                 data-kt-scroll="true" data-kt-scroll-activate="true"
                 data-kt-scroll-max-height="auto"
                 data-kt-scroll-dependencies="#kt_modal_add_movement_header"
                 data-kt-scroll-wrappers="#kt_modal_add_movement_scroll"
                 data-kt-scroll-offset="300px">

                {{-- Bill --}}
                <x-form.select
                    label="Bill"
                    model="bill_id"
                    name="bill_id"
                    placeholder="Select a bill"
                    :options="$bills->mapWithKeys(fn($bill) => [$bill->id => $bill->code . ' - ' . $bill->customer->name])->toArray()"
                    required
                />

                {{-- Amount --}}
                <x-form.input-text
                    label="Amount"
                    model="amount"
                    name="amount"
                    type="number"
                    step="0.01"
                    placeholder="Enter amount"
                    required
                />

                {{-- Movement Type --}}
                <x-form.select
                    label="Movement Type"
                    model="movement_type"
                    name="movement_type"
                    placeholder="Select a movement type"
                    :options="['credit' => 'Credit', 'debit' => 'Debit']"
                    required
                />

                {{-- Origin --}}
                <x-form.input-text
                    label="Origin"
                    model="origin"
                    name="origin"
                    placeholder="Enter origin"
                />

                {{-- Description --}}
                <x-form.text-area
                    label="Description"
                    model="description"
                    name="description"
                    placeholder="Enter description"
                />
            </div>
        </form>
    </x-slot>

    <x-slot name="footer">
        <button type="reset" class="btn btn-light me-3" data-bs-dismiss="modal" aria-label="Close" wire:loading.attr="disabled">Discard</button>
        <button type="submit" form="kt_modal_add_movement_form" class="btn btn-primary">
            <span class="indicator-label" wire:loading.remove>Submit</span>
            <span class="indicator-progress" wire:loading wire:target="submit">
                Please wait...
                <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
            </span>
        </button>
    </x-slot>
</x-modal.base.default-modal>
