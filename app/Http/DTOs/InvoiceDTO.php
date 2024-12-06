<?php

namespace App\Http\DTOs;

use App\Http\Interfaces\StoreRequestInterface;
use App\Http\Interfaces\UpdateRequestInterface;

class InvoiceDTO extends DTO
{
    public function __construct(
        private readonly int $billId,
        private readonly ?string $accruedOn,
        private readonly ?float $amount,
        private readonly ?string $scheduledAt,
        private readonly ?string $description,
        private readonly ?array $settings,
    ) {}

    public static function fromRequest(StoreRequestInterface|UpdateRequestInterface $request): self
    {
        return new self(
            $request->get('bill_id'),
            $request->get('accrued_on', null),
            $request->get('amount', null),
            $request->get('scheduled_at', null),
            $request->get('description', null),
            $request->get('settings', null),
        );
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['bill_id'],
            $data['accrued_on'] ?? null,
            $data['amount'] ?? null,
            $data['scheduled_at'] ?? null,
            $data['description'] ?? null,
            $data['settings'] ?? null,
        );
    }
}
