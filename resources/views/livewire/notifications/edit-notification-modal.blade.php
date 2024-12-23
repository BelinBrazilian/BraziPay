<x-modal.base.default-modal id="kt_modal_update_notification" title="Update Notification" size="mw-650px">
    <x-slot name="body">
        {{-- Form --}}
        <form id="kt_modal_update_notification_form" class="form" wire:submit.prevent="submit">
            {{-- Status --}}
            <x-form.select
                label="Status"
                model="status"
                name="status"
                :options="['active' => 'Active', 'inactive' => 'Inactive']"
                placeholder="Select status"
                required
            />

            {{-- Notification Type --}}
            <x-form.input-text
                label="Notification Type"
                model="notification_type"
                name="notification_type"
                placeholder="Enter notification type"
                required
            />

            {{-- Name --}}
            <x-form.input-text
                label="Name"
                model="name"
                name="name"
                placeholder="Enter notification name"
                required
            />

            {{-- Subject --}}
            <x-form.input-text
                label="Subject"
                model="subject"
                name="subject"
                placeholder="Enter notification subject"
                required
            />

            {{-- Content --}}
            <x-form.textarea
                label="Content"
                model="content"
                name="content"
                placeholder="Enter notification content"
                required
            />

            {{-- Trigger Type --}}
            <x-form.input-text
                label="Trigger Type"
                model="trigger_type"
                name="trigger_type"
                placeholder="Enter trigger type"
            />

            {{-- Trigger Day --}}
            <x-form.input-number
                label="Trigger Day"
                model="trigger_day"
                name="trigger_day"
                placeholder="Enter trigger day"
            />

            {{-- BCC --}}
            <x-form.input-email
                label="BCC"
                model="bcc"
                name="bcc"
                placeholder="Enter BCC email"
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
        const modal = document.querySelector('#kt_modal_update_notification');

        modal.addEventListener('show.bs.modal', (e) => {
            const notificationId = e.relatedTarget.getAttribute('data-notification-id');
            Livewire.dispatch('modal.show.notification', [notificationId]);
        });
    </script>
@endpush
