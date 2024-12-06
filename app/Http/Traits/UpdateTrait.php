<?php

namespace App\Http\Traits;

use App\Http\Interfaces\UpdateRequestInterface;
use Illuminate\View\View;

trait UpdateTrait
{
    public function update(UpdateRequestInterface $request, int $id): View
    {
        $data = $this->api->update($request, $id);

        return View(getViewName($this::class, 'show'), compact('data'));
    }
}
