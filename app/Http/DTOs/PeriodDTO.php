<?php

namespace App\Http\DTOs;

use App\Http\Interfaces\StoreRequestInterface;
use App\Http\Interfaces\UpdateRequestInterface;

class PeriodDTO extends DTO
{
    public function __construct(
        private readonly int $externalId,
        private readonly int $subscriptionId,
        private readonly string $billingAt,
        private readonly int $cycle,
        private readonly string $startAt,
        private readonly string $endAt,
        private readonly int $duration,
    ) {}

    public static function fromRequest(StoreRequestInterface|UpdateRequestInterface $request): self
    {
        return new self(
            $request->get('external_id', null),
            $request->get('subscription_id'),
            $request->get('billing_at'),
            $request->get('cycle'),
            $request->get('start_at'),
            $request->get('end_at'),
            $request->get('duration'),
        );
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['external_id'] ?? null,
            $data['subscription_id'],
            $data['billing_at'],
            $data['cycle'],
            $data['start_at'],
            $data['end_at'],
            $data['duration'],
        );
    }
}
