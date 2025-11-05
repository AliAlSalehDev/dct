<?php

namespace App\Http\Controllers\Api\V1;

use App\DTOs\ProductData;
use App\Services\ProductServiceInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductStoreRequest;
use App\Http\Resources\ProductResource;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ProductController extends Controller
{
    use ApiResponseTrait;

    public function __construct(private readonly ProductServiceInterface $service) {}

    // Get All Products with Filters and Pagination
    public function index(Request $request): ResourceCollection
    {
        $filters = $request->only(['q','category_id','stock_status','min_price','max_price','sort_by','sort_dir']);
        $perPage = (int)($request->integer('per_page', 10));

        $page = $this->service->list($filters, $perPage);

        return ProductResource::collection($page)
            ->additional(['success' => true]);
    }

    // Store a New Product
    public function store(ProductStoreRequest $request)
    {
        try {
            $dto = new ProductData(
                name: $request->string('name')->toString(),
                price: (float)$request->input('price'),
                stock_status: $request->string('stock_status')->toString(),
                category_id: (int)$request->input('category_id'),
            );

            $product = $this->service->add($dto);

            return $this->created(['data' => new ProductResource($product)]);
        } catch (\Throwable $e) {
            \Log::error('Product store failed', ['error' => $e->getMessage()]);

            return $this->error('Failed to create product', 500, [
                'hint' => 'Please try again.',
            ]);
        }
    }

    // Delete a Product by ID
    public function destroy(int $id)
    {
        $deleted = $this->service->delete($id);

        if (! $deleted) {
            return $this->error("Product not found", 404);
        }

        return $this->ok(['message' => 'Product deleted successfully']);
    }
}
