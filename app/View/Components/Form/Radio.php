<?php

namespace App\View\Components\Form;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Radio extends Component
{
    /**
     * Create a new component instance.
     *
     * @param string $label The label for the radio group.
     * @param string $model The Livewire model binding.
     * @param string $name The name attribute for the radio inputs.
     * @param array $options The options for the radio buttons (key-value pairs).
     * @param array|null $descriptions Additional descriptions for the radio buttons (optional).
     */
    public function __construct(
        public string $label,
        public string $model,
        public string $name,
        public array $options,
        public ?array $descriptions = null // Added support for descriptions
    ) {}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.form.radio');
    }
}
