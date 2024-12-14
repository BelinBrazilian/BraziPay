<x-modal.base.default-modal id="kt_modal_add_customer" title="Add Customer" size="mw-650px">
    <x-slot name="body">
        <form id="kt_modal_add_customer_form" class="form" wire:submit.prevent="submit" enctype="multipart/form-data">
            <input type="hidden" wire:model.live="customer_id" name="customer_id"/>

            <div class="d-flex flex-column scroll-y px-5 px-lg-10" id="kt_modal_add_customer_scroll"
                 data-kt-scroll="true" data-kt-scroll-activate="true"
                 data-kt-scroll-max-height="auto"
                 data-kt-scroll-dependencies="#kt_modal_add_customer_header"
                 data-kt-scroll-wrappers="#kt_modal_add_customer_scroll"
                 data-kt-scroll-offset="300px">

                {{-- Name --}}
                <x-form.input-text
                    label="Name"
                    model="name"
                    name="name"
                    placeholder="Full name"
                    required
                />

                {{-- Email --}}
                <x-form.input-text
                    label="Email"
                    model="email"
                    name="email"
                    type="email"
                    placeholder="example@domain.com"
                    required
                />

                {{-- Registry Code --}}
                <x-form.input-text
                    label="Registry Code"
                    model="registry_code"
                    name="registry_code"
                    placeholder="Registry code"
                />

                {{-- Code --}}
                <x-form.input-text
                    label="Code"
                    model="code"
                    name="code"
                    placeholder="Customer code"
                />

                {{-- Notes --}}
                <x-form.text-area
                    label="Notes"
                    model="notes"
                    name="notes"
                    placeholder="Additional notes"
                />

                {{-- Address --}}
                <h5 class="fw-bold mb-4">Address</h5>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <x-form.input-text
                            label="Street"
                            model="address.street"
                            name="address.street"
                            placeholder="Street"
                        />
                    </div>
                    <div class="col-md-6 mb-3">
                        <x-form.input-text
                            label="Number"
                            model="address.number"
                            name="address.number"
                            placeholder="Number"
                        />
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <x-form.input-text
                            label="City"
                            model="address.city"
                            name="address.city"
                            placeholder="City"
                        />
                    </div>
                    <div class="col-md-6 mb-3">
                        <x-form.input-text
                            label="State"
                            model="address.state"
                            name="address.state"
                            placeholder="State"
                        />
                    </div>
                </div>

                {{-- Phones --}}
                <h5 class="fw-bold mb-4">Phones</h5>
                @foreach($phones as $index => $phone)
                    <div class="d-flex align-items-center mb-3">
                        <x-form.input-text
                            model="phones.{{ $index }}.number"
                            name="phones[{{ $index }}].number"
                            placeholder="Phone number"
                            class="form-control form-control-solid me-3"
                        />
                        <button type="button" class="btn btn-sm btn-danger" wire:click="removePhone({{ $index }})">Remove</button>
                    </div>
                @endforeach
                <button type="button" class="btn btn-sm btn-primary" wire:click="addPhone">Add Phone</button>
            </div>
        </form>
    </x-slot>

    <x-slot name="footer">
        <button type="reset" class="btn btn-light me-3" data-bs-dismiss="modal" aria-label="Close" wire:loading.attr="disabled">Discard</button>
        <button type="submit" form="kt_modal_add_customer_form" class="btn btn-primary">
            <span class="indicator-label" wire:loading.remove>Submit</span>
            <span class="indicator-progress" wire:loading wire:target="submit">
                Please wait...
                <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
            </span>
        </button>
    </x-slot>
</x-modal.base.default-modal>
