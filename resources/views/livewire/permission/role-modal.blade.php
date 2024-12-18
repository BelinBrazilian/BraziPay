<x-modal.base.default-modal id="kt_modal_update_role" title="Update Role" size="mw-750px">
    <x-slot name="body">
        {{-- Warning Notice --}}
        <x-alert.warning class="mb-9">
            Ensure that you double-check role permissions to avoid accidental privilege escalations.
        </x-alert.warning>

        {{-- Form --}}
        <form id="kt_modal_update_role_form" class="form" wire:submit.prevent="submit">
            {{-- Scroll Wrapper --}}
            <div class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_update_role_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto"
                 data-kt-scroll-dependencies="#kt_modal_update_role_header" data-kt-scroll-wrappers="#kt_modal_update_role_scroll" data-kt-scroll-offset="300px">

                {{-- Role Name Input --}}
                <x-form.input-text
                    label="Role Name"
                    model="name"
                    name="name"
                    placeholder="Enter a role name"
                    required
                />

                {{-- Role Permissions Table --}}
                <div class="fv-row">
                    <label class="fs-5 fw-bold form-label mb-2">Role Permissions</label>
                    <div class="table-responsive">
                        <table class="table align-middle table-row-dashed fs-6 gy-5">
                            <tbody class="text-gray-600 fw-semibold">
                            <tr>
                                <td class="text-gray-800">Administrator Access
                                    <span class="ms-1" data-bs-toggle="tooltip" title="Allows a full access to the system">
                                            {!! getIcon('information-5','text-gray-500 fs-6') !!}
                                        </span>
                                </td>
                                <td>
                                    <label class="form-check form-check-sm form-check-custom form-check-solid me-9">
                                        <input class="form-check-input" type="checkbox" id="kt_roles_select_all" wire:model="check_all" wire:change="checkAll" />
                                        <span class="form-check-label" for="kt_roles_select_all">Select all</span>
                                    </label>
                                </td>
                            </tr>
                            @foreach($permissions_by_group as $group => $permissions)
                                <tr>
                                    <td class="text-gray-800">{{ ucwords($group) }}</td>
                                    <td>
                                        <div class="d-flex flex-wrap">
                                            @foreach($permissions as $permission)
                                                <label class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                                    <input class="form-check-input" type="checkbox" wire:model="checked_permissions" value="{{ $permission->name }}" />
                                                    <span class="form-check-label">{{ ucwords(Str::before($permission->name, ' ')) }}</span>
                                                </label>
                                            @endforeach
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            {{-- Actions --}}
            <div class="text-center pt-15">
                <button type="reset" class="btn btn-light me-3" data-bs-dismiss="modal" aria-label="Close" wire:loading.attr="disabled">Discard</button>
                <button type="submit" class="btn btn-primary">
                    <span class="indicator-label" wire:loading.remove>Submit</span>
                    <span class="indicator-progress" wire:loading wire:target="submit">
                        Please wait...
                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                    </span>
                </button>
            </div>
        </form>
    </x-slot>
</x-modal.base.default-modal>

@push('scripts')
    <script>
        const modal = document.querySelector('#kt_modal_update_role');

        modal.addEventListener('show.bs.modal', (e) => {
            Livewire.dispatch('modal.show.role_name', [e.relatedTarget.getAttribute('data-role-id')]);
        });
    </script>
@endpush
