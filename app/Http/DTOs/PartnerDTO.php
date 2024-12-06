<?php

namespace App\Http\DTOs;

use App\Http\Interfaces\StoreRequestInterface;
use App\Http\Interfaces\UpdateRequestInterface;

class PartnerDTO extends DTO
{
    public function __construct(
        private readonly int $addressId,
        private readonly int $bankAccountId,
        private readonly string $name,
        private readonly string $companyName,
        private readonly ?string $cpf,
        private readonly ?string $cnpj,
        private readonly string $userName,
        private readonly string $userEmail,
        private readonly string $economicActivity,
        private readonly string $phoneNumber,
        private readonly ?string $templateCode,
    ) {}

    public static function fromRequest(StoreRequestInterface|UpdateRequestInterface $request): self
    {
        return new self(
            $request->get('address_id'),
            $request->get('bank_account_id'),
            $request->get('name'),
            $request->get('company_name'),
            $request->get('cpf', null),
            $request->get('cnpj', null),
            $request->get('user_name'),
            $request->get('user_email'),
            $request->get('economic_activity'),
            $request->get('phone_number'),
            $request->get('template_code', null),
        );
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['address_id'],
            $data['bank_account_id'],
            $data['name'],
            $data['company_name'],
            $data['cpf'] ?? null,
            $data['cnpj'] ?? null,
            $data['user_name'],
            $data['user_email'],
            $data['economic_activity'],
            $data['phone_number'],
            $data['template_code'] ?? null,
        );
    }
}
