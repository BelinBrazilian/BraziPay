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

    public ?int $page = 1;

    public ?int $per_page = 15;

    public ?string $include;

    public ?string $with;

    public ?string $fields;

    public ?string $select;

    public function __constuct() {}
}
