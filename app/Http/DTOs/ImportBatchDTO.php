<?php

namespace App\Http\DTOs;

use App\Http\Interfaces\StoreRequestInterface;
use App\Http\Interfaces\UpdateRequestInterface;

class ImportBatchDTO extends DTO
{
    public function __construct(
        private readonly int $paymentMethodId,
        private readonly ?int $paymentCompanyId,
        private readonly ?string $fileName,
        private readonly ?string $filePath,
        private readonly string $status,
    ) {}

    public static function fromRequest(StoreRequestInterface | UpdateRequestInterface $request): self
    {
        return new self(
            $request->get('payment_method_id'),
            $request->get('payment_company_id', null),
            $request->get('file_name', null),
            $request->get('file_path', null),
            $request->get('status', 'pending'), // Definindo 'pending' como padrão
        );
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['payment_method_id'],
            $data['payment_company_id'] ?? null,
            $data['file_name'] ?? null,
            $data['file_path'] ?? null,
            $data['status'] ?? 'pending', // Definindo 'pending' como padrão
        );
    }
}