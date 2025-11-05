<?php

namespace App\Repositories;

use App\Models\Product;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface ProductRepositoryInterface
{
    public function paginate(array $filters, int $perPage = 10): LengthAwarePaginator;
    public function create(array $attributes): Product;
    public function delete(int $id): bool;
}
