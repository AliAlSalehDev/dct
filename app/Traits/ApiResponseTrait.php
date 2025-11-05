<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;

trait ApiResponseTrait
{
    protected function ok(array $data = [], int $code = 200): JsonResponse
    {
        return response()->json(['success' => true] + $data, $code);
    }

    protected function created(array $data = []): JsonResponse
    {
        return $this->ok($data, 201);
    }

    protected function error(string $message, int $code = 400, array $meta = []): JsonResponse
    {
        return response()->json(['success' => false, 'message' => $message, 'meta' => $meta], $code);
    }
}
