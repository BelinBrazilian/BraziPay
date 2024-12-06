<?php

namespace App\Http\Traits;

use Illuminate\View\View;

trait DestroyTrait
{
    public function destroy(int $id, array $queryParams = []): View
    {
        $data = $this->api->destroy($id, $queryParams);

        return View(getViewName($this::class, 'index'), compact('data'));
    }
}
