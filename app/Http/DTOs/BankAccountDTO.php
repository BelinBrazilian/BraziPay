<?php

namespace App\Http\DTOs;

use App\Http\Interfaces\StoreRequestInterface;
use App\Http\Interfaces\UpdateRequestInterface;

class BankAccountDTO extends DTO
{
    public function __construct(
        private readonly string $bankCode,
        private readonly string $bankBranch,
        private readonly string $accountNumber,
        private readonly string $accountDigit,
    ) {}

    public static function fromRequest(StoreRequestInterface|UpdateRequestInterface $request): self
    {
        return new self(
            $request->get('bank_code'),
            $request->get('bank_branch'),
            $request->get('account_number'),
            $request->get('account_digit'),
        );
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['bank_code'],
            $data['bank_branch'],
            $data['account_number'],
            $data['account_digit'],
        );
    }
}
