<?php

namespace App\Http\DTOs;

use App\Http\Interfaces\StoreRequestInterface;
use App\Http\Interfaces\UpdateRequestInterface;

class PaymentMethodDTO extends DTO
{
    public function __construct(
        private readonly string $publicName,
        private readonly string $name,
        private readonly string $code,
        private readonly string $type,
        private readonly string $status,
        private readonly mixed $settings,
        private readonly string $setSubscriptionOnSuccess,
        private readonly string $allowAsAlternative,
        private readonly int $maximumAttempts,
    ) {}

    public static function fromRequest(StoreRequestInterface|UpdateRequestInterface $request): self
    {
        return new self(
            $request->get('public_name'),
            $request->get('name'),
            $request->get('code'),
            $request->get('type'),
            $request->get('status'),
            $request->get('settings'),
            $request->get('set_subscription_on_success'),
            $request->get('allow_as_alternative'),
            $request->get('maximum_attempts'),
        );
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['public_name'],
            $data['name'],
            $data['code'],
            $data['type'],
            $data['status'],
            $data['settings'],
            $data['set_subscription_on_success'],
            $data['allow_as_alternative'],
            $data['maximum_attempts'],
        );
    }
}
