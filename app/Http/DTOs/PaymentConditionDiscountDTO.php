<?php

namespace App\Http\DTOs;

use App\Http\Interfaces\StoreRequestInterface;
use App\Http\Interfaces\UpdateRequestInterface;

class PaymentConditionDiscountDTO extends DTO
{
    public function __construct(
        private readonly int $paymentConditionId,
        private readonly float $value,
        private readonly string $valueType,
        private readonly int $daysBeforeDue,
    ) {}

    public static function fromRequest(StoreRequestInterface|UpdateRequestInterface $request): self
    {
        return new self(
            $request->get('payment_condition_id'),
            $request->get('value'),
            $request->get('value_type'),
            $request->get('days_before_due'),
        );
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['payment_condition_id'],
            $data['value'],
            $data['value_type'],
            $data['days_before_due'],
        );
    }
}
