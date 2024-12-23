<x-modal.base.default-modal id="kt_modal_add_user" title="Add User" size="mw-650px">
    <x-slot name="body">
        {{-- Form --}}
        <form id="kt_modal_add_user_form" class="form" wire:submit.prevent="submit" enctype="multipart/form-data">
            {{-- Scroll --}}
            <div class="d-flex flex-column scroll-y px-5 px-lg-10" id="kt_modal_add_user_scroll" data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_user_header" data-kt-scroll-wrappers="#kt_modal_add_user_scroll" data-kt-scroll-offset="300px">

                {{-- Avatar --}}
                <x-form.image-input
                    label="Avatar"
                    model="avatar"
                    name="avatar"
                    :currentImage="$saved_avatar ?? null"
                    placeholder="{{ asset('svg/files/blank-image.svg') }}"
                    :allowedFileTypes="['.png', '.jpg', '.jpeg']"
                />

                {{-- Full Name --}}
                <x-form.input-text
                    label="Full Name"
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

                {{-- Roles --}}
                <x-form.radio-group
                    label="Role"
                    model="role"
                    name="role"
                    :options="$roles->pluck('description', 'name')"
                    :descriptions="$roles->pluck('description')"
                    required
                />

            </div>
            {{-- End Scroll --}}

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
            {{-- End Actions --}}
        </form>
    </x-slot>
</x-modal.base.default-modal>
