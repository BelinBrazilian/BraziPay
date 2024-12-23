<x-modal.base.default-modal id="kt_modal_add_notification" title="Add Notification" size="mw-650px">
    <x-slot name="body">
        <form id="kt_modal_add_notification_form" class="form" wire:submit.prevent="submit" enctype="multipart/form-data">
            <input type="hidden" wire:model.live="notification_id" name="notification_id"/>

            <div class="d-flex flex-column scroll-y px-5 px-lg-10" id="kt_modal_add_notification_scroll"
                 data-kt-scroll="true" data-kt-scroll-activate="true"
                 data-kt-scroll-max-height="auto"
                 data-kt-scroll-dependencies="#kt_modal_add_notification_header"
                 data-kt-scroll-wrappers="#kt_modal_add_notification_scroll"
                 data-kt-scroll-offset="300px">

                {{-- Status --}}
                <x-form.select
                    label="Status"
                    model="status"
                    name="status"
                    placeholder="Select a status"
                    :options="['active' => 'Active', 'inactive' => 'Inactive']"
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
                    placeholder="Enter subject"
                    required
                />

                {{-- Content --}}
                <x-form.text-area
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
                <x-form.input-text
                    label="Trigger Day"
                    model="trigger_day"
                    name="trigger_day"
                    type="number"
                    placeholder="Enter trigger day"
                />

                {{-- BCC --}}
                <x-form.input-text
                    label="BCC"
                    model="bcc"
                    name="bcc"
                    type="email"
                    placeholder="Enter BCC email address"
                />
            </div>
        </form>
    </x-slot>

    <x-slot name="footer">
        <button type="reset" class="btn btn-light me-3" data-bs-dismiss="modal" aria-label="Close" wire:loading.attr="disabled">Discard</button>
        <button type="submit" form="kt_modal_add_notification_form" class="btn btn-primary">
            <span class="indicator-label" wire:loading.remove>Submit</span>
            <span class="indicator-progress" wire:loading wire:target="submit">
                Please wait...
                <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
            </span>
        </button>
    </x-slot>
</x-modal.base.default-modal>
