<?php

namespace App\Services;

use App\DTOs\ProductData;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use App\Models\Product;

interface ProductServiceInterface
{
    public function list(array $filters, int $perPage = 10): LengthAwarePaginator;
    public function add(ProductData $data): Product;
    public function delete(int $id): bool;
}
