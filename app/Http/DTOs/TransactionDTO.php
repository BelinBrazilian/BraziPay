<?php

namespace App\Http\DTOs;

use App\Http\Interfaces\StoreRequestInterface;
use App\Http\Interfaces\UpdateRequestInterface;

class TransactionDTO extends DTO
{
    public function __construct(
        private readonly int $chargeId,
        private readonly int $paymentMethodId,
        private readonly float $amount,
        private readonly ?string $paidAt,
        private readonly ?string $comments,
    ) {}

    public static function fromRequest(StoreRequestInterface | UpdateRequestInterface $request): self
    {
        return new self(
            $request->get('charge_id'),
            $request->get('payment_method_id'),
            $request->get('amount'),
            $request->get('paid_at', null),
            $request->get('comments', null),
        );
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['charge_id'],
            $data['payment_method_id'],
            $data['amount'],
            $data['paid_at'] ?? null,
            $data['comments'] ?? null,
        );
    }
}