<?php

namespace App\DataTables;

use App\Models\Subscription;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class SubscriptionsDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param  QueryBuilder  $query  Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->editColumn('plan', function (Subscription $subscription) {
                return $subscription->plan ? $subscription->plan->name : 'N/A';
            })
            ->editColumn('customer', function (Subscription $subscription) {
                return $subscription->customer ? $subscription->customer->name : 'N/A';
            })
            ->editColumn('payment_method', function (Subscription $subscription) {
                return $subscription->paymentMethod ? $subscription->paymentMethod->name : 'N/A';
            })
            ->editColumn('installments', function (Subscription $subscription) {
                return $subscription->installments ?: 'N/A';
            })
            ->editColumn('start_at', function (Subscription $subscription) {
                return $subscription->start_at ? $subscription->start_at->format('d M Y') : 'N/A';
            })
            ->addColumn('actions', function (Subscription $subscription) {
                return view('pages/subscriptions/columns/_actions', compact('subscription'));
            })
            ->rawColumns(['actions'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Subscription $model): QueryBuilder
    {
        return $model->newQuery()->with(['plan', 'customer', 'paymentMethod']);
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('subscriptions-table')
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
            Column::make('plan')->title('Plan'),
            Column::make('customer')->title('Customer'),
            Column::make('payment_method')->title('Payment Method'),
            Column::make('installments')->title('Installments'),
            Column::make('start_at')->title('Start Date'),
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
        return 'Subscriptions_'.date('YmdHis');
    }
}
