<x-modal.base.default-modal id="kt_modal_update_customer" title="Update Customer" size="mw-650px">
    <x-slot name="body">
        {{-- Form --}}
        <form id="kt_modal_update_customer_form" class="form" wire:submit.prevent="submit">
            {{-- Name --}}
            <x-form.input-text
                label="Name"
                model="name"
                name="name"
                placeholder="Enter customer name"
                required
            />

            {{-- Email --}}
            <x-form.input-email
                label="Email"
                model="email"
                name="email"
                placeholder="Enter customer email"
            />

            {{-- Registry Code --}}
            <x-form.input-text
                label="Registry Code"
                model="registry_code"
                name="registry_code"
                placeholder="Enter registry code"
            />

            {{-- Code --}}
            <x-form.input-text
                label="Code"
                model="code"
                name="code"
                placeholder="Enter customer code"
            />

            {{-- Notes --}}
            <x-form.textarea
                label="Notes"
                model="notes"
                name="notes"
                placeholder="Enter additional notes"
            />

            {{-- Address --}}
            <h5 class="fw-bold mb-5">Address</h5>
            <x-form.input-text
                label="Street"
                model="address.street"
                name="address.street"
                placeholder="Enter street"
            />
            <x-form.input-text
                label="Number"
                model="address.number"
                name="address.number"
                placeholder="Enter number"
            />
            <x-form.input-text
                label="City"
                model="address.city"
                name="address.city"
                placeholder="Enter city"
            />
            <x-form.input-text
                label="State"
                model="address.state"
                name="address.state"
                placeholder="Enter state"
            />

            {{-- Phones --}}
            <h5 class="fw-bold mt-10 mb-5">Phones</h5>
            @foreach($phones as $index => $phone)
                <div class="d-flex align-items-center mb-3">
                    <x-form.input-text
                        label="Phone Number"
                        model="phones.{{ $index }}.number"
                        name="phones[{{ $index }}].number"
                        placeholder="Enter phone number"
                    />
                    <button type="button" class="btn btn-sm btn-danger ms-3" wire:click="removePhone({{ $index }})">
                        Remove
                    </button>
                </div>
            @endforeach
            <button type="button" class="btn btn-sm btn-primary" wire:click="addPhone">Add Phone</button>

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
