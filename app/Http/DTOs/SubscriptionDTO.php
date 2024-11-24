<?php

namespace App\Http\DTOs;

use App\Http\Interfaces\StoreRequestInterface;
use App\Http\Interfaces\UpdateRequestInterface;

class SubscriptionDTO extends DTO
{
    public function __construct(
        private readonly int $planId,
        private readonly int $customerId,
        private readonly int $paymentMethodId,
        private readonly ?int $externalId,
        private readonly string $code,
        private readonly ?string $startAt,
        private readonly ?int $installments,
        private readonly ?string $billingTriggerType,
        private readonly ?int $billingTriggerDay,
        private readonly ?int $billingCycles,
        private readonly ?bool $invoiceSplit,
    ) {}

    public static function fromRequest(StoreRequestInterface | UpdateRequestInterface $request): self
    {
        return new self(
            $request->get('plan_id'),
            $request->get('customer_id'),
            $request->get('payment_method_id'),
            $request->get('external_id', null),
            $request->get('code'),
            $request->get('start_at', null),
            $request->get('installments', null),
            $request->get('billing_trigger_type', null),
            $request->get('billing_trigger_day', null),
            $request->get('billing_cycles', null),
            $request->get('invoice_split', null),
        );
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['plan_id'],
            $data['customer_id'],
            $data['payment_method_id'],
            $data['external_id'] ?? null,
            $data['code'],
            $data['start_at'] ?? null,
            $data['installments'] ?? null,
            $data['billing_trigger_type'] ?? null,
            $data['billing_trigger_day'] ?? null,
            $data['billing_cycles'] ?? null,
            $data['invoice_split'] ?? null,
        );
    }
}