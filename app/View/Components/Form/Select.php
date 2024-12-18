<?php

namespace App\View\Components\Form;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Select extends Component
{
    /**
     * Create a new component instance.
     *
     * @param string $label The label for the select field.
     * @param string $model The Livewire model binding.
     * @param string $name The name attribute for the select field.
     * @param array $options The options for the select field (key-value pairs).
     * @param string|null $placeholder The placeholder text for the select.
     * @param bool $required Whether the field is required (default: false).
     */
    public function __construct(
        public string $label,
        public string $model,
        public string $name,
        public array $options,
        public ?string $placeholder = 'Select an option',
        public bool $required = false
    ) {}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.form.select');
    }
}
