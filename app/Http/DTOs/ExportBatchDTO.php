<?php

namespace App\Http\DTOs;

use App\Http\Interfaces\StoreRequestInterface;
use App\Http\Interfaces\UpdateRequestInterface;

class ExportBatchDTO extends DTO
{
    public function __construct(
        private readonly int $paymentMethodId,
        private readonly ?int $paymentCompanyId,
    ) {}

    public static function fromRequest(StoreRequestInterface|UpdateRequestInterface $request): self
    {
        return new self(
            $request->get('payment_method_id'),
            $request->get('payment_company_id', null),
        );
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['payment_method_id'],
            $data['payment_company_id'] ?? null,
        );
    }
}
