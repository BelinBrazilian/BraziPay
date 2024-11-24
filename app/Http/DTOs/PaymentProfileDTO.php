<?php

namespace App\Http\DTOs;

use App\Http\Interfaces\StoreRequestInterface;
use App\Http\Interfaces\UpdateRequestInterface;

class PaymentProfileDTO extends DTO
{
    public function __construct(
        private readonly int $customerId,
        private readonly ?string $token,
        private readonly ?string $holderName,
        private readonly ?string $registryCode,
        private readonly ?string $bankBranch,
        private readonly ?string $bankAccount,
        private readonly ?string $cardExpiration,
        private readonly bool $allowAsFallback,
        private readonly ?string $cardNumber,
        private readonly ?string $cardCvv,
        private readonly ?string $cardToken,
        private readonly ?string $gatewayId,
        private readonly ?string $paymentMethodCode,
        private readonly ?string $paymentCompanyCode,
        private readonly ?string $gatewayToken,
    ) {}

    public static function fromRequest(StoreRequestInterface | UpdateRequestInterface $request): self
    {
        return new self(
            $request->get('customer_id'),
            $request->get('token', null),
            $request->get('holder_name', null),
            $request->get('registry_code', null),
            $request->get('bank_branch', null),
            $request->get('bank_account', null),
            $request->get('card_expiration', null),
            $request->get('allow_as_fallback', false),
            $request->get('card_number', null),
            $request->get('card_cvv', null),
            $request->get('card_token', null),
            $request->get('gateway_id', null),
            $request->get('payment_method_code', null),
            $request->get('payment_company_code', null),
            $request->get('gateway_token', null),
        );
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['customer_id'],
            $data['token'] ?? null,
            $data['holder_name'] ?? null,
            $data['registry_code'] ?? null,
            $data['bank_branch'] ?? null,
            $data['bank_account'] ?? null,
            $data['card_expiration'] ?? null,
            $data['allow_as_fallback'] ?? false,
            $data['card_number'] ?? null,
            $data['card_cvv'] ?? null,
            $data['card_token'] ?? null,
            $data['gateway_id'] ?? null,
            $data['payment_method_code'] ?? null,
            $data['payment_company_code'] ?? null,
            $data['gateway_token'] ?? null,
        );
    }
}