<?php

namespace App\DataTables;

use App\Models\Movement;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class MovementsDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param  QueryBuilder  $query  Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->editColumn('amount', function (Movement $movement) {
                return sprintf('$%s', number_format($movement->amount, 2));
            })
            ->editColumn('movement_type', function (Movement $movement) {
                return ucfirst($movement->movement_type);
            })
            ->editColumn('origin', function (Movement $movement) {
                return ucfirst($movement->origin);
            })
            ->addColumn('bill', function (Movement $movement) {
                return $movement->bill ? $movement->bill->code : 'N/A';
            })
            ->addColumn('actions', function (Movement $movement) {
                return view('pages/movements/columns/_actions', compact('movement'));
            })
            ->rawColumns(['actions'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Movement $model): QueryBuilder
    {
        return $model->newQuery()->with('bill');
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('movements-table')
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
            Column::make('movement_type')->title('Type'),
            Column::make('origin')->title('Origin'),
            Column::make('description')->title('Description'),
            Column::make('bill')->title('Bill Code'),
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
        return 'Movements_'.date('YmdHis');
    }
}
