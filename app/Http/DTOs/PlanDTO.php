<?php

namespace App\Http\DTOs;

use App\Http\DTOs\DTO;
use App\Http\Enums\PlanBillingTriggerTypeEnum as EnumsPlanBillingTriggerTypeEnum;
use App\Http\Enums\PlanIntervalEnum as EnumsPlanIntervalEnum;
use App\Http\Enums\PlanStatusEnum as EnumsPlanStatusEnum;
use App\Http\Interfaces\StoreRequestInterface;
use App\Http\Interfaces\UpdateRequestInterface;

class PlanDTO extends DTO
{
    public function __construct(
        private readonly string $name,
        private readonly EnumsPlanIntervalEnum $interval,
        private readonly int $interval_count,
        private readonly ?string $interval_name,
        private readonly EnumsPlanBillingTriggerTypeEnum $billing_trigger_type,
        private readonly int $billing_trigger_day,
        private readonly ?int $billing_cycles,
        private readonly ?string $description,
        private readonly int $installments,
        private readonly ?string $invoice_split,
        private readonly EnumsPlanStatusEnum $status,
        private readonly ?string $metadata,
    ) {}

    public static function fromRequest(StoreRequestInterface | UpdateRequestInterface $request): self
    {
        return new self(
            $request->get('name'),
            $request->get('interval'),
            $request->get('interval_count'),
            $request->get('interval_name', null),
            $request->get('billing_trigger_type'),
            $request->get('billing_trigger_day'),
            $request->get('billing_cycles', null),
            $request->get('description', null),
            $request->get('installments'),
            $request->get('invoice_split', null),
            $request->get('status'),
            $request->get('metadata', null),
        );
    }

    public static function fromArray(array $data) : self
    {
        return new self(
            $data['name'],
            $data['interval'],
            $data['interval_count'],
            $data['interval_name'] ?? null,
            $data['billing_trigger_type'],
            $data['billing_trigger_day'],
            $data['billing_cycles'] ?? null,
            $data['description'] ?? null,
            $data['installments'],
            $data['invoice_split'] ?? null,
            $data['status'],
            $data['metadata'] ?? null,
        );
    }
}
