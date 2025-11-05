<?php

namespace App\Services;

use App\DTOs\ProductData;
use App\Repositories\ProductRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Throwable;

class ProductService implements ProductServiceInterface
{
    public function __construct(
        private readonly ProductRepositoryInterface $products
    ) {}

    public function list(array $filters, int $perPage = 10): LengthAwarePaginator
    {
        return $this->products->paginate($filters, $perPage);
    }

    public function add(ProductData $data): Product
    {
        // Retry up to 3 times (helps with deadlocks)
        return DB::transaction(function () use ($data) {
            $product = $this->products->create([
                'name'         => $data->name,
                'price'        => $data->price,
                'stock_status' => $data->stock_status,
                'category_id'  => $data->category_id,
            ]);
            return $product;
        }, 3);
    }

    public function delete(int $id): bool
    {
        return $this->products->delete($id);
    }
}
