<x-default-layout>

    @section('title')
        Subscriptions
    @endsection

    @section('breadcrumbs')
        {{ Breadcrumbs::render('subscription-management.subscriptions.index') }}
    @endsection

    <div class="card">
        {{-- begin::Card header --}}
        <div class="card-header border-0 pt-6">
            {{-- begin::Card title --}}
            <div class="card-title">
                {{-- begin::Search --}}
                <div class="d-flex align-items-center position-relative my-1">
                    {!! getIcon('magnifier', 'fs-3 position-absolute ms-5') !!}
                    <input type="text" data-kt-subscriptions-table-filter="search" class="form-control form-control-solid w-250px ps-13" placeholder="Search subscription" id="mySearchInput"/>
                </div>
                {{-- end::Search --}}
            </div>
            {{-- end::Card title --}}

            {{-- begin::Card toolbar --}}
            <div class="card-toolbar">
                {{-- begin::Toolbar --}}
                <div class="d-flex justify-content-end" data-kt-subscriptions-table-toolbar="base">
                    {{-- begin::Add subscription --}}
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_add_subscription">
                        {!! getIcon('plus', 'fs-2', '', 'i') !!}
                        Add Subscription
                    </button>
                    {{-- end::Add subscription --}}
                </div>
                {{-- end::Toolbar --}}

                {{-- begin::Modal --}}
                <livewire:subscription.add-subscription-modal></livewire:subscription.add-subscription-modal>
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
                window.LaravelDataTables['subscriptions-table'].search(this.value).draw();
            });
            document.addEventListener('livewire:init', function () {
                Livewire.on('success', function () {
                    $('#kt_modal_add_subscription').modal('hide');
                    window.LaravelDataTables['subscriptions-table'].ajax.reload();
                });
            });
            $('#kt_modal_add_subscription').on('hidden.bs.modal', function () {
                Livewire.dispatch('new_subscription');
            });
        </script>
    @endpush

</x-default-layout>
