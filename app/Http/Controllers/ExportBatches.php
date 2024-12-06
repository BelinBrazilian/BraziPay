<?php

namespace App\Http\Controllers;

use App\Http\Controllers\API\ExportBatches as APIExportBatches;
use App\Http\Traits\IndexTrait;
use App\Http\Traits\ShowTrait;
use App\Http\Traits\StoreTrait;
use Illuminate\Contracts\View\View;

final class ExportBatches extends Controller
{
    use IndexTrait, ShowTrait, StoreTrait;

    public function __construct(private readonly APIExportBatches $api) {}

    public function approve(int $id): View
    {
        $data = $this->api->approve($id);

        return View('import_batches.show', compact('data'));
    }
}
