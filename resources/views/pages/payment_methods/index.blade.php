<x-default-layout>

    @section('title')
        Payment Methods
    @endsection

    @section('breadcrumbs')
        {{ Breadcrumbs::render('payment-method-management.payment-methods.index') }}
    @endsection

    <div class="card">
        {{-- begin::Card header --}}
        <div class="card-header border-0 pt-6">
            {{-- begin::Card title --}}
            <div class="card-title">
                {{-- begin::Search --}}
                <div class="d-flex align-items-center position-relative my-1">
                    {!! getIcon('magnifier', 'fs-3 position-absolute ms-5') !!}
                    <input type="text" data-kt-payment-methods-table-filter="search" class="form-control form-control-solid w-250px ps-13" placeholder="Search payment method" id="mySearchInput"/>
                </div>
                {{-- end::Search --}}
            </div>
            {{-- end::Card title --}}

            {{-- begin::Card toolbar --}}
            <div class="card-toolbar">
                {{-- begin::Toolbar --}}
                <div class="d-flex justify-content-end" data-kt-payment-methods-table-toolbar="base">
                    {{-- begin::Add payment method --}}
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_add_payment_method">
                        {!! getIcon('plus', 'fs-2', '', 'i') !!}
                        Add Payment Method
                    </button>
                    {{-- end::Add payment method --}}
                </div>
                {{-- end::Toolbar --}}

                {{-- begin::Modal --}}
                <livewire:payment-method.add-payment-method-modal></livewire:payment-method.add-payment-method-modal>
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
                window.LaravelDataTables['payment-methods-table'].search(this.value).draw();
            });
            document.addEventListener('livewire:init', function () {
                Livewire.on('success', function () {
                    $('#kt_modal_add_payment_method').modal('hide');
                    window.LaravelDataTables['payment-methods-table'].ajax.reload();
                });
            });
            $('#kt_modal_add_payment_method').on('hidden.bs.modal', function () {
                Livewire.dispatch('new_payment_method');
            });
        </script>
    @endpush

</x-default-layout>
