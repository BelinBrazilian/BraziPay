<?php

namespace App\Http\DTOs;

use App\Exceptions\InvalidPhoneAssociationException;
use App\Http\DTOs\DTO;
use App\Http\Interfaces\StoreRequestInterface;
use App\Http\Interfaces\UpdateRequestInterface;

class PhoneDTO extends DTO
{
    public function __construct(
        public readonly ?int $customerId = null,
        public readonly ?int $merchantId = null,
        public readonly string $phoneType,
        public readonly string $number,
        public readonly ?string $extension = null,
    ) {
        if ((is_null($customerId) && is_null($merchantId)) || (!is_null($customerId) && !is_null($merchantId))) {
            throw new InvalidPhoneAssociationException();
        }
    }

    public static function fromRequest(StoreRequestInterface | UpdateRequestInterface $request): self
    {
        return new self(
            $request->get('customer_id', null),
            $request->get('merchant_id', null),
            $request->get('phone_type'),
            $request->get('number'),
            $request->get('extension', null),
        );
    }

    public static function fromArray(array $data) : self
    {
        return new self(
            $data['customer_id'] ?? null,
            $data['merchant_id'] ?? null,
            $data['phone_type'],
            $data['number'],
            $data['extension'] ?? null,
        );
    }
}
