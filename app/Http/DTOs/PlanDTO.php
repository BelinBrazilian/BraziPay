<?php

namespace App\Http\DTOs;

use App\Http\Interfaces\StoreRequestInterface;
use App\Http\Interfaces\UpdateRequestInterface;

class PlanDTO extends DTO
{
    public function __construct(
        private readonly ?int $externalId,
        private readonly string $code,
        private readonly string $name,
        private readonly string $interval,
        private readonly int $intervalCount,
        private readonly string $billingTriggerType,
        private readonly int $billingTriggerDay,
        private readonly ?int $billingCycles,
        private readonly ?string $description,
        private readonly ?int $installments,
        private readonly ?bool $invoiceSplit,
        private readonly ?string $status,
    ) {}

    public static function fromRequest(StoreRequestInterface | UpdateRequestInterface $request): self
    {
        return new self(
            $request->get('external_id', null),
            $request->get('code'),
            $request->get('name'),
            $request->get('interval'),
            $request->get('interval_count'),
            $request->get('billing_trigger_type'),
            $request->get('billing_trigger_day'),
            $request->get('billing_cycles', null),
            $request->get('description', null),
            $request->get('installments', null),
            $request->get('invoice_split', null),
            $request->get('status', null),
        );
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['external_id'] ?? null,
            $data['code'],
            $data['name'],
            $data['interval'],
            $data['interval_count'],
            $data['billing_trigger_type'],
            $data['billing_trigger_day'],
            $data['billing_cycles'] ?? null,
            $data['description'] ?? null,
            $data['installments'] ?? null,
            $data['invoice_split'] ?? null,
            $data['status'] ?? null,
        );
    }
}