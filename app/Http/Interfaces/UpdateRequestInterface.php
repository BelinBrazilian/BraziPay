<?php

namespace App\Http\Interfaces;

/**
 * @method array all()
 * @method mixed get()
 */
interface UpdateRequestInterface
{
    public function authorize(): bool;

    public function rules(): array;
}
