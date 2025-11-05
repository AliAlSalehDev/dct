<?php

namespace App\DTOs;

class ProductData
{
    public function __construct(
        public readonly string $name,
        public readonly float $price,
        public readonly string $stock_status,
        public readonly int $category_id
    ) {}
}
