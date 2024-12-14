<?php

namespace App\DataTables;

use App\Models\PaymentMethod;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class PaymentMethodsDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param  QueryBuilder  $query  Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->editColumn('public_name', function (PaymentMethod $paymentMethod) {
                return ucwords($paymentMethod->public_name);
            })
            ->editColumn('status', function (PaymentMethod $paymentMethod) {
                $badgeClass = $paymentMethod->status === 'active' ? 'badge-success' : 'badge-danger';
                return sprintf('<span class="badge %s">%s</span>', $badgeClass, ucfirst($paymentMethod->status));
            })
            ->editColumn('type', function (PaymentMethod $paymentMethod) {
                return ucfirst($paymentMethod->type);
            })
            ->addColumn('actions', function (PaymentMethod $paymentMethod) {
                return view('pages/payment-methods/columns/_actions', compact('paymentMethod'));
            })
            ->rawColumns(['status', 'actions'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(PaymentMethod $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('payment-methods-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('rt'."<'row'<'col-sm-12'tr>><'d-flex justify-content-between'<'col-sm-12 col-md-5'i><'d-flex justify-content-between'p>>")
            ->addTableClass('table align-middle table-row-dashed fs-6 gy-5 dataTable no-footer text-gray-600 fw-semibold')
            ->setTableHeadClass('text-start text-muted fw-bold fs-7 text-uppercase gs-0')
            ->orderBy(1)
            ->drawCallback('function() { /* Custom draw scripts here */ }');
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('public_name')->title('Public Name'),
            Column::make('code')->title('Code'),
            Column::make('type')->title('Type'),
            Column::make('status')->title('Status'),
            Column::computed('actions')
                ->addClass('text-end text-nowrap')
                ->exportable(false)
                ->printable(false),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'PaymentMethods_'.date('YmdHis');
    }
}
