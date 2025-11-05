<?php

namespace App\Repositories;

use App\Models\Product;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class EloquentProductRepository implements ProductRepositoryInterface
{
    public function paginate(array $filters, int $perPage = 10): LengthAwarePaginator
    {
        $query = Product::query()->with('category');

        if (!empty($filters['q'])) {
            $q = trim($filters['q']);
            $query->where('name', 'like', "%{$q}%");
        }

        if (!empty($filters['category_id'])) {
            $query->where('category_id', (int)$filters['category_id']);
        }

        if (!empty($filters['stock_status'])) {
            $query->where('stock_status', $filters['stock_status']);
        }

        if (!empty($filters['min_price'])) {
            $query->where('price', '>=', (float)$filters['min_price']);
        }

        if (!empty($filters['max_price'])) {
            $query->where('price', '<=', (float)$filters['max_price']);
        }

        $sortBy = in_array(($filters['sort_by'] ?? ''), ['name','price','created_at']) ? $filters['sort_by'] : 'created_at';
        $sortDir = ($filters['sort_dir'] ?? 'desc') === 'asc' ? 'asc' : 'desc';

        return $query->orderBy($sortBy, $sortDir)->paginate($perPage)->appends($filters);
    }

    public function create(array $attributes): Product
    {
        return Product::create($attributes)->load('category');
    }

    public function delete(int $id): bool
    {
        $product = Product::find($id);
        if (! $product) {
            return false;
        }

        return (bool) $product->delete();
    }
}
