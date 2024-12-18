<x-default-layout>

    @section('title')
        Bills
    @endsection

    @section('breadcrumbs')
        {{ Breadcrumbs::render('bills.index') }}
    @endsection

    <div class="card">
        {{-- begin::Card header --}}
        <div class="card-header border-0 pt-6">
            {{-- begin::Card title --}}
            <div class="card-title">
                {{-- begin::Search --}}
                <div class="d-flex align-items-center position-relative my-1">
                    {!! getIcon('magnifier', 'fs-3 position-absolute ms-5') !!}
                    <input type="text" data-kt-bills-table-filter="search" class="form-control form-control-solid w-250px ps-13" placeholder="Search bills" id="billSearchInput"/>
                </div>
                {{-- end::Search --}}
            </div>
            {{-- begin::Card title --}}

            {{-- begin::Card toolbar --}}
            <div class="card-toolbar">
                {{-- begin::Toolbar --}}
                <div class="d-flex justify-content-end" data-kt-bills-table-toolbar="base">
                    {{-- begin::Add Bill --}}
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_add_bill">
                        {!! getIcon('plus', 'fs-2', '', 'i') !!}
                        Add Bill
                    </button>
                    {{-- end::Add Bill --}}
                </div>
                {{-- end::Toolbar --}}

                {{-- begin::Modal --}}
                <livewire:bill.add-bill-modal></livewire:bill.add-bill-modal>
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
            document.getElementById('billSearchInput').addEventListener('keyup', function () {
                window.LaravelDataTables['bills-table'].search(this.value).draw();
            });
            document.addEventListener('livewire:init', function () {
                Livewire.on('success', function () {
                    $('#kt_modal_add_bill').modal('hide');
                    window.LaravelDataTables['bills-table'].ajax.reload();
                });
            });
            $('#kt_modal_add_bill').on('hidden.bs.modal', function () {
                Livewire.dispatch('new_bill');
            });
        </script>
    @endpush

</x-default-layout>
