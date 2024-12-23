<?php

namespace App\DataTables;

use App\Models\Product;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class ProductsDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param  QueryBuilder  $query  Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->editColumn('name', function (Product $product) {
                return ucwords($product->name);
            })
            ->editColumn('status', function (Product $product) {
                $badgeClass = $product->status === 'active' ? 'badge-success' : 'badge-danger';

                return sprintf('<span class="badge %s">%s</span>', $badgeClass, ucfirst($product->status->label()));
            })
            ->editColumn('invoice', function (Product $product) {
                return $product->invoice->label();
            })
            ->addColumn('pricing', function (Product $product) {
                return $product->pricingSchema
                    ? sprintf('%s (%s)', $product->pricingSchema->price, $product->pricingSchema->currency)
                    : 'N/A';
            })
            ->addColumn('actions', function (Product $product) {
                return view('pages/products/columns/_actions', compact('product'));
            })
            ->rawColumns(['status', 'actions'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Product $model): QueryBuilder
    {
        return $model->newQuery()->with('pricingSchema');
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('products-table')
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
            Column::make('name')->title('Name'),
            Column::make('code')->title('Code'),
            Column::make('unit')->title('Unit'),
            Column::make('status')->title('Status'),
            Column::make('invoice')->title('Invoice Type'),
            Column::make('pricing')->title('Pricing Schema'),
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
        return 'Products_'.date('YmdHis');
    }
}
