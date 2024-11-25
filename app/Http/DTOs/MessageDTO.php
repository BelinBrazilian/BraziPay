<?php

namespace App\Http\DTOs;

use App\Http\Interfaces\StoreRequestInterface;
use App\Http\Interfaces\UpdateRequestInterface;

class MessageDTO extends DTO
{
    public function __construct(
        private readonly int $customerId,
        private readonly int $chargeId,
        private readonly int $notificationId,
        private readonly ?string $email,
    ) {}

    public static function fromRequest(StoreRequestInterface | UpdateRequestInterface $request): self
    {
        return new self(
            $request->get('customer_id'),
            $request->get('charge_id'),
            $request->get('notification_id'),
            $request->get('email', null),
        );
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['customer_id'],
            $data['charge_id'],
            $data['notification_id'],
            $data['email'] ?? null,
        );
    }
}