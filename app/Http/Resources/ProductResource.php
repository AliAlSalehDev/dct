<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id'           => $this->id,
            'name'         => $this->name,
            'price'        => (float)$this->price,
            'stockStatus'  => $this->stock_status,
            'category'     => [
                'id'   => $this->category->id,
                'name' => $this->category->name,
            ],
            'createdAt'    => $this->created_at?->toISOString(),
        ];
    }
}
