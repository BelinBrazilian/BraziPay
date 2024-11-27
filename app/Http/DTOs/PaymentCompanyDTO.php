<?php

namespace App\Http\DTOs;

use App\Http\Interfaces\StoreRequestInterface;
use App\Http\Interfaces\UpdateRequestInterface;

class PaymentCompanyDTO extends DTO
{
    public function __construct(
        private readonly string $name,
        private readonly string $code,
    ) {}

    public static function fromRequest(StoreRequestInterface|UpdateRequestInterface $request): self
    {
        return new self(
            $request->get('name'),
            $request->get('code'),
        );
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['name'],
            $data['code'],
        );
    }
}
