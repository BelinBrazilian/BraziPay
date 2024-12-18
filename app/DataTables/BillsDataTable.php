<?php

namespace App\DataTables;

use App\Models\Bill;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class BillsDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param  QueryBuilder  $query  Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->editColumn('customer', function (Bill $bill) {
                return $bill->customer ? $bill->customer->name : 'N/A';
            })
            ->editColumn('payment_method', function (Bill $bill) {
                return $bill->paymentMethod ? $bill->paymentMethod->name : 'N/A';
            })
            ->editColumn('due_at', function (Bill $bill) {
                return $bill->due_at ? $bill->due_at->format('d/m/Y') : 'N/A';
            })
            ->addColumn('total_amount', function (Bill $bill) {
                return $bill->billItems->sum('amount');
            })
            ->addColumn('actions', function (Bill $bill) {
                return view('pages/bills/columns/_actions', compact('bill'));
            })
            ->rawColumns(['actions'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Bill $model): QueryBuilder
    {
        return $model->newQuery()->with(['customer', 'paymentMethod', 'billItems']);
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('bills-table')
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
            Column::make('customer')->title('Customer'),
            Column::make('payment_method')->title('Payment Method'),
            Column::make('billing_at')->title('Billing Date'),
            Column::make('due_at')->title('Due Date'),
            Column::computed('total_amount')->title('Total Amount')
                ->exportable(false)
                ->printable(false),
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
        return 'Bills_'.date('YmdHis');
    }
}
