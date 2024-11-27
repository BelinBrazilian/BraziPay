<?php

namespace App\Http\DTOs;

use App\Http\Interfaces\StoreRequestInterface;
use App\Http\Interfaces\UpdateRequestInterface;

class AddressDTO extends DTO
{
    public function __construct(
        private readonly string $street,
        private readonly string $number,
        private readonly ?string $additionalDetails,
        private readonly string $zipcode,
        private readonly string $neighborhood,
        private readonly string $city,
        private readonly string $state,
        private readonly string $country,
    ) {}

    public static function fromRequest(StoreRequestInterface|UpdateRequestInterface $request): self
    {
        return new self(
            $request->get('street'),
            $request->get('number'),
            $request->get('additional_details', null),
            $request->get('zipcode'),
            $request->get('neighborhood'),
            $request->get('city'),
            $request->get('state'),
            $request->get('country'),
        );
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['street'],
            $data['number'],
            $data['additional_details'] ?? null,
            $data['zipcode'],
            $data['neighborhood'],
            $data['city'],
            $data['state'],
            $data['country'],
        );
    }
}
