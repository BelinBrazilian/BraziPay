<?php

namespace App\Http\Controllers\API;

use Livewire\Component;

class ApiController extends Component
{
    // Livewire paginator
    public ?string $search;

    // Default Laravel/PHP paginator
    public ?string $filter;

    public ?string $sort;

    public ?int $page;

    public ?int $per_page;

    public ?string $include;

    public ?string $with;

    public ?string $fields;

    public ?string $select;

    public function __constuct() {}
}
