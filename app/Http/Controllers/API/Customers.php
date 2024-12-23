<?php

namespace App\Http\Controllers\API;

use App\Http\Services\CustomerService;
use App\Http\Traits\ApiTraits;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Customers extends ApiController
{
    use ApiTraits;

    public function __construct(
        private readonly Request $request,
        private readonly CustomerService $service,
        private readonly Customer $model,
    ) {}

    public function unarchive(mixed $id): Customer
    {
        return $this->service->unarchive($id);
    }

    public function datatableList(Request $request)
    {
        $draw = $request->input('draw', 0);
        $start = $request->input('start', 0);
        $length = $request->input('length', 10);
        $columns = $request->input('columns');
        $searchValue = $request->input('search.value');

        $orderColumn = $request->input('order.0.column', 0);
        $orderDir = $request->input('order.0.dir', 'asc');

        $query = Customer::query()->with(['address', 'phones']);

        // Filtragem de pesquisa
        if ($searchValue) {
            $searchColumns = ['name', 'email'];
            $query->where(function ($query) use ($searchValue, $searchColumns) {
                foreach ($searchColumns as $column) {
                    $query->orWhere(DB::raw("LOWER($column)"), 'LIKE', '%' . strtolower($searchValue) . '%');
                }
            });
        }

        $orderColumnName = $columns[$orderColumn]['data'] ?? 'id';

        // Ordenação e Paginação
        $query->orderBy($orderColumnName, $orderDir);
        $totalRecords = $query->count();
        $records = $query->offset($start)->limit($length)->get();

        return [
            'draw' => $draw,
            'recordsTotal' => $totalRecords,
            'recordsFiltered' => $totalRecords,
            'data' => $records,
            'orderColumnName' => $orderColumnName,
        ];
    }
    
    public function _index(array $queryParams = [])
    {
        return $this->service->_index($queryParams);
    }
}
