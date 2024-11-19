<?php

namespace App\Http\DTOs;

class AddressDTO extends DTO
{
    public function __construct(
        public readonly string $street,
        public readonly string $number,
        public readonly ?string $additionalDetails,
        public readonly string $zipcode,
        public readonly string $neighborhood,
        public readonly string $city,
        public readonly string $state,
        public readonly string $country,
    ) {}

    public static function fromRequest($request): self
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
