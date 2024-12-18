<?php

namespace App\View\Components\Form;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class InputText extends Component
{
    /**
     * Create a new component instance.
     *
     * @param string $label The label for the input field.
     * @param string $model The Livewire model binding.
     * @param string $name The name attribute for the input field.
     * @param string|null $type The input type (default: text).
     * @param string|null $placeholder The placeholder text for the input.
     * @param bool $required Whether the field is required (default: false).
     * @param string|null $tooltip The tooltip for the input field.
     */
    public function __construct(
        public string $label,
        public string $model,
        public string $name,
        public ?string $type = 'text',
        public ?string $placeholder = null,
        public bool $required = false,
        public ?string $tooltip = null
    ) {}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.form.input-text');
    }
}
