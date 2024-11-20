<?php

namespace App\Http\DTOs;

use App\Http\Interfaces\StoreRequestInterface;
use App\Http\Interfaces\UpdateRequestInterface;

class PricingRangeDTO extends DTO
{
    public function __construct(
        private readonly int $start_quantity,
        private readonly int $end_quantity,
        private readonly float $price,
        private readonly float $overage_price
    ) {}

    public static function fromRequest(StoreRequestInterface | UpdateRequestInterface $request): self
    {
        return new self(
            $request->get('start_quantity'),
            $request->get('end_quantity'),
            $request->get('price'),
            $request->get('overage_price'),
        );
    }

    public static function fromArray(array $data) : self
    {
        return new self(
            $data['start_quantity'],
            $data['end_quantity'],
            $data['price'],
            $data['overage_price'],
        );
    }
}
