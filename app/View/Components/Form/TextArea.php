<?php

namespace App\View\Components\Form;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class TextArea extends Component
{
    /**
     * Create a new component instance.
     *
     * @param string $label The label for the textarea.
     * @param string $model The Livewire model binding.
     * @param string $name The name attribute for the textarea.
     * @param string|null $placeholder The placeholder text for the textarea.
     * @param bool $required Whether the field is required (default: false).
     */
    public function __construct(
        public string $label,
        public string $model,
        public string $name,
        public ?string $placeholder = null,
        public bool $required = false
    ) {}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.form.text-area');
    }
}
