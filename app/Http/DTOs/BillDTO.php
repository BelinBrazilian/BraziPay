<?php

namespace App\Http\DTOs;

use App\Http\Interfaces\StoreRequestInterface;
use App\Http\Interfaces\UpdateRequestInterface;

class BillDTO extends DTO
{
    public function __construct(
        private readonly int $customerId,
        private readonly int $paymentMethodId,
        private readonly ?int $paymentProfileId,
        private readonly ?int $paymentConditionId,
        private readonly ?int $externalId,
        private readonly string $code,
        private readonly ?int $installments,
        private readonly ?string $billingAt,
        private readonly ?string $dueAt,
        private readonly ?string $brandTid,
    ) {}

    public static function fromRequest(StoreRequestInterface | UpdateRequestInterface $request): self
    {
        return new self(
            $request->get('customer_id'),
            $request->get('payment_method_id'),
            $request->get('payment_profile_id', null),
            $request->get('payment_condition_id', null),
            $request->get('external_id', null),
            $request->get('code'),
            $request->get('installments', null),
            $request->get('billing_at', null),
            $request->get('due_at', null),
            $request->get('brand_tid', null),
        );
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['customer_id'],
            $data['payment_method_id'],
            $data['payment_profile_id'] ?? null,
            $data['payment_condition_id'] ?? null,
            $data['external_id'] ?? null,
            $data['code'],
            $data['installments'] ?? null,
            $data['billing_at'] ?? null,
            $data['due_at'] ?? null,
            $data['brand_tid'] ?? null,
        );
    }
}