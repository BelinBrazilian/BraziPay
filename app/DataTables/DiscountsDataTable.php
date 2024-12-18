<?php

namespace App\DataTables;

use App\Models\Discount;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class DiscountsDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param  QueryBuilder  $query  Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->editColumn('discount_type', function (Discount $discount) {
                return ucfirst($discount->discount_type);
            })
            ->editColumn('percentage', function (Discount $discount) {
                return $discount->percentage ? sprintf('%s%%', $discount->percentage) : 'N/A';
            })
            ->editColumn('amount', function (Discount $discount) {
                return $discount->amount ? sprintf('$%s', number_format($discount->amount, 2)) : 'N/A';
            })
            ->editColumn('cycles', function (Discount $discount) {
                return $discount->cycles ?: 'Unlimited';
            })
            ->addColumn('product_item', function (Discount $discount) {
                return $discount->productItem ? $discount->productItem->name : 'N/A';
            })
            ->addColumn('actions', function (Discount $discount) {
                return view('pages/discounts/columns/_actions', compact('discount'));
            })
            ->rawColumns(['actions'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Discount $model): QueryBuilder
    {
        return $model->newQuery()->with('productItem');
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('discounts-table')
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
            Column::make('discount_type')->title('Type'),
            Column::make('percentage')->title('Percentage'),
            Column::make('amount')->title('Amount'),
            Column::make('quantity')->title('Quantity'),
            Column::make('cycles')->title('Cycles'),
            Column::make('product_item')->title('Product Item'),
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
        return 'Discounts_'.date('YmdHis');
    }
}
