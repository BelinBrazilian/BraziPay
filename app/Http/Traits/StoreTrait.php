<?php

namespace App\Http\Traits;

use App\Http\Interfaces\StoreRequestInterface;
use Illuminate\View\View;

trait StoreTrait
{
    public function store(StoreRequestInterface $request): View
    {
        $data = $this->api->store($request);

        return View(getViewName($this::class, 'show'), compact('data'));
    }
}
