<?php

namespace App\DataTables;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class CustomersDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param  QueryBuilder  $query  Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->editColumn('name', function (Customer $customer) {
                return ucwords($customer->name);
            })
            ->editColumn('email', function (Customer $customer) {
                return sprintf('<a href="mailto:%s">%s</a>', $customer->email, $customer->email);
            })
            ->addColumn('address', function (Customer $customer) {
                if ($customer->address) {
                    return sprintf(
                        '%s, %s - %s, %s - %s',
                        $customer->address->street,
                        $customer->address->number,
                        $customer->address->neighborhood,
                        $customer->address->city,
                        $customer->address->state
                    );
                }
                return 'N/A';
            })
            ->addColumn('phones', function (Customer $customer) {
                return $customer->phones->map(function ($phone) {
                    return $phone->number;
                })->implode(', ');
            })
            ->addColumn('actions', function (Customer $customer) {
                return view('pages/customers/columns/_actions', compact('customer'));
            })
            ->rawColumns(['email', 'actions'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Customer $model): QueryBuilder
    {
        return $model->newQuery()->with(['address', 'phones']);
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('customers-table')
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
            Column::make('email')->title('Email'),
            Column::make('address')->title('Address'),
            Column::make('phones')->title('Phones'),
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
        return 'Customers_'.date('YmdHis');
    }
}
