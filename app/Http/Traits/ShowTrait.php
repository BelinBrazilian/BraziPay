<?php

namespace App\Http\Traits;

use Illuminate\View\View;

trait ShowTrait
{
    public function show(int $id): View
    {
        $data = $this->api->show($id);

        return View(getViewName($this::class, 'show'), compact('data'));
    }
}
