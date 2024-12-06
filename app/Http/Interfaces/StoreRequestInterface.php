<?php

namespace App\Http\Interfaces;

/**
 * @method array all()
 * @method mixed get()
 */
interface StoreRequestInterface
{
    public function authorize(): bool;

    public function rules(): array;
}
