<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Category;
use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        // Optional search + simple limit to keep payload light
        $q     = trim((string) $request->query('q', ''));
        $limit = (int) $request->integer('limit', 100);

        $query = Category::query()->select(['id','name'])->orderBy('name');
        if ($q !== '') {
            $query->where('name', 'like', "%{$q}%");
        }

        $items = $query->limit($limit)->get();

        return CategoryResource::collection($items)->additional(['success' => true]);
    }
}
