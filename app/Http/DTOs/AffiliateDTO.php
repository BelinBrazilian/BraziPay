<?php

namespace App\Http\DTOs;

use App\Http\Interfaces\StoreRequestInterface;
use App\Http\Interfaces\UpdateRequestInterface;

class AffiliateDTO extends DTO
{
    public function __construct(
        private readonly ?int $addressId,
        private readonly ?int $bankAccountId,
        private readonly string $login,
        private readonly int $status,
        private readonly bool $enabled,
        private readonly ?string $name,
        private readonly ?string $cpf,
        private readonly ?string $cnpj,
        private readonly ?string $tradeName,
        private readonly ?string $companyName,
        private readonly ?string $phone,
    ) {}

    public static function fromRequest(StoreRequestInterface|UpdateRequestInterface $request): self
    {
        return new self(
            $request->get('address_id', null),
            $request->get('bank_account_id', null),
            $request->get('login'),
            $request->get('status', 0),
            $request->get('enabled', false),
            $request->get('name', null),
            $request->get('cpf', null),
            $request->get('cnpj', null),
            $request->get('trade_name', null),
            $request->get('company_name', null),
            $request->get('phone', null),
        );
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['address_id'] ?? null,
            $data['bank_account_id'] ?? null,
            $data['login'],
            $data['status'] ?? 0,
            $data['enabled'] ?? false,
            $data['name'] ?? null,
            $data['cpf'] ?? null,
            $data['cnpj'] ?? null,
            $data['trade_name'] ?? null,
            $data['company_name'] ?? null,
            $data['phone'] ?? null,
        );
    }
}
