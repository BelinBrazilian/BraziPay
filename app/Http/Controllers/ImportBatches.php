<?php

namespace App\Http\Controllers;

use App\Http\Controllers\API\ImportBatches as APIImportBatches;
use App\Http\Traits\IndexTrait;
use App\Http\Traits\ShowTrait;
use App\Http\Traits\StoreTrait;

final class ImportBatches extends Controller
{
    use IndexTrait, ShowTrait, StoreTrait;

    public function __construct(private readonly APIImportBatches $api) {}
}
