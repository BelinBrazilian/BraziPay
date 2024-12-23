<x-default-layout>

    @section('title')
        Movements
    @endsection

    @section('breadcrumbs')
        {{ Breadcrumbs::render('movement-management.movements.index') }}
    @endsection

    <div class="card">
        {{-- begin::Card header --}}
        <div class="card-header border-0 pt-6">
            {{-- begin::Card title --}}
            <div class="card-title">
                {{-- begin::Search --}}
                <div class="d-flex align-items-center position-relative my-1">
                    {!! getIcon('magnifier', 'fs-3 position-absolute ms-5') !!}
                    <input type="text" data-kt-movement-table-filter="search" class="form-control form-control-solid w-250px ps-13" placeholder="Search movement" id="mySearchInput"/>
                </div>
                {{-- end::Search --}}
            </div>
            {{-- end::Card title --}}

            {{-- begin::Card toolbar --}}
            <div class="card-toolbar">
                {{-- begin::Toolbar --}}
                <div class="d-flex justify-content-end" data-kt-movement-table-toolbar="base">
                    {{-- begin::Add movement --}}
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_add_movement">
                        {!! getIcon('plus', 'fs-2', '', 'i') !!}
                        Add Movement
                    </button>
                    {{-- end::Add movement --}}
                </div>
                {{-- end::Toolbar --}}

                {{-- begin::Modal --}}
                <livewire:movement.add-movement-modal></livewire:movement.add-movement-modal>
                {{-- end::Modal --}}
            </div>
            {{-- end::Card toolbar --}}
        </div>
        {{-- end::Card header --}}

        {{-- begin::Card body --}}
        <div class="card-body py-4">
            {{-- begin::Table --}}
            <div class="table-responsive">
                {{ $dataTable->table() }}
            </div>
            {{-- end::Table --}}
        </div>
        {{-- end::Card body --}}
    </div>

    @push('scripts')
        {{ $dataTable->scripts() }}
        <script>
            document.getElementById('mySearchInput').addEventListener('keyup', function () {
                window.LaravelDataTables['movements-table'].search(this.value).draw();
            });
            document.addEventListener('livewire:init', function () {
                Livewire.on('success', function () {
                    $('#kt_modal_add_movement').modal('hide');
                    window.LaravelDataTables['movements-table'].ajax.reload();
                });
            });
            $('#kt_modal_add_movement').on('hidden.bs.modal', function () {
                Livewire.dispatch('new_movement');
            });
        </script>
    @endpush

</x-default-layout>