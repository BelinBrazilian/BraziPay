<?php

namespace App\Http\Traits;

use Illuminate\View\View;

trait IndexTrait
{
    public function index(array $queryParams = []): View
    {
        $data = $this->api->index($queryParams);

        return View(getViewName($this::class, 'index'), compact('data'));
    }
}
