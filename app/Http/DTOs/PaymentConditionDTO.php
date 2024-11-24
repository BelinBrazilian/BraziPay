<?php

namespace App\Http\DTOs;

use App\Http\Interfaces\StoreRequestInterface;
use App\Http\Interfaces\UpdateRequestInterface;

class PaymentConditionDTO extends DTO
{
    public function __construct(
        private readonly ?float $penaltyFeeValue,
        private readonly ?string $penaltyFeeType,
        private readonly ?float $dailyFeeValue,
        private readonly ?string $dailyFeeType,
        private readonly ?int $afterDueDays,
    ) {}

    public static function fromRequest(StoreRequestInterface | UpdateRequestInterface $request): self
    {
        return new self(
            $request->get('penalty_fee_value', null),
            $request->get('penalty_fee_type', null),
            $request->get('daily_fee_value', null),
            $request->get('daily_fee_type', null),
            $request->get('after_due_days', null),
        );
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['penalty_fee_value'] ?? null,
            $data['penalty_fee_type'] ?? null,
            $data['daily_fee_value'] ?? null,
            $data['daily_fee_type'] ?? null,
            $data['after_due_days'] ?? null,
        );
    }
}