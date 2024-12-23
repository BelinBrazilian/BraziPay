<x-default-layout>

    @section('title')
        Plans
    @endsection

    @section('breadcrumbs')
        {{ Breadcrumbs::render('plan-management.plans.index') }}
    @endsection

    <div class="card">
        {{-- begin::Card header --}}
        <div class="card-header border-0 pt-6">
            {{-- begin::Card title --}}
            <div class="card-title">
                {{-- begin::Search --}}
                <div class="d-flex align-items-center position-relative my-1">
                    {!! getIcon('magnifier', 'fs-3 position-absolute ms-5') !!}
                    <input type="text" data-kt-plans-table-filter="search" class="form-control form-control-solid w-250px ps-13" placeholder="Search plan" id="mySearchInput"/>
                </div>
                {{-- end::Search --}}
            </div>
            {{-- end::Card title --}}

            {{-- begin::Card toolbar --}}
            <div class="card-toolbar">
                {{-- begin::Toolbar --}}
                <div class="d-flex justify-content-end" data-kt-plans-table-toolbar="base">
                    {{-- begin::Add plan --}}
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_add_plan">
                        {!! getIcon('plus', 'fs-2', '', 'i') !!}
                        Add Plan
                    </button>
                    {{-- end::Add plan --}}
                </div>
                {{-- end::Toolbar --}}

                {{-- begin::Modal --}}
                <livewire:plan.add-plan-modal></livewire:plan.add-plan-modal>
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
                window.LaravelDataTables['plans-table'].search(this.value).draw();
            });
            document.addEventListener('livewire:init', function () {
                Livewire.on('success', function () {
                    $('#kt_modal_add_plan').modal('hide');
                    window.LaravelDataTables['plans-table'].ajax.reload();
                });
            });
            $('#kt_modal_add_plan').on('hidden.bs.modal', function () {
                Livewire.dispatch('new_plan');
            });
        </script>
    @endpush

</x-default-layout>
