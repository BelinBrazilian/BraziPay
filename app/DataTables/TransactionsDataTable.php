<?php

namespace App\DataTables;

use App\Models\Transaction;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class TransactionsDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param  QueryBuilder  $query  Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->editColumn('amount', function (Transaction $transaction) {
                return sprintf('$%s', number_format($transaction->amount, 2));
            })
            ->editColumn('paid_at', function (Transaction $transaction) {
                return $transaction->paid_at ? $transaction->paid_at->format('d M Y, H:i') : 'N/A';
            })
            ->addColumn('payment_method', function (Transaction $transaction) {
                return $transaction->paymentMethod ? $transaction->paymentMethod->public_name : 'N/A';
            })
            ->addColumn('actions', function (Transaction $transaction) {
                return view('pages/transactions/columns/_actions', compact('transaction'));
            })
            ->rawColumns(['actions'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Transaction $model): QueryBuilder
    {
        return $model->newQuery()->with('paymentMethod');
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('transactions-table')
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
            Column::make('amount')->title('Amount'),
            Column::make('paid_at')->title('Paid At'),
            Column::make('payment_method')->title('Payment Method'),
            Column::make('comments')->title('Comments'),
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
        return 'Transactions_'.date('YmdHis');
    }
}
