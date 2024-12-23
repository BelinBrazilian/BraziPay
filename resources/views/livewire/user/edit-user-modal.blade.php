<x-modal.base.default-modal id="kt_modal_update_user" title="Update User" size="mw-650px">
    <x-slot name="body">
        {{-- Form --}}
        <form id="kt_modal_update_user_form" class="form" wire:submit.prevent="submit">
            {{-- Profile Photo --}}
            <x-form.file-upload
                label="Profile Photo"
                model="profile_photo_path"
                name="profile_photo_path"
                placeholder="Upload profile photo"
                accept=".png, .jpg, .jpeg"
            />

            {{-- Name --}}
            <x-form.input-text
                label="Full Name"
                model="name"
                name="name"
                placeholder="Enter full name"
                required
            />

            {{-- Email --}}
            <x-form.input-email
                label="Email Address"
                model="email"
                name="email"
                placeholder="Enter email address"
                required
            />

            {{-- Password --}}
            <x-form.input-password
                label="Password"
                model="password"
                name="password"
                placeholder="Enter new password"
            />

            {{-- Address --}}
            <x-form.select
                label="Default Address"
                model="default_address"
                name="default_address"
                :options="$addresses"
                placeholder="Select default address"
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
        const modal = document.querySelector('#kt_modal_update_user');

        modal.addEventListener('show.bs.modal', (e) => {
            const userId = e.relatedTarget.getAttribute('data-user-id');
            Livewire.dispatch('modal.show.user', [userId]);
        });
    </script>
@endpush
