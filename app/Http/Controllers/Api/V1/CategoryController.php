<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryCreateRequest;
use App\Models\Category;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $categories = \App\Models\Category::query()->paginate(32);

        return response()->json($categories);
    }

    public function store(CategoryCreateRequest $request): JsonResponse
    {
        $validated = $request->validated();

        $category = Category::create($validated);

        return response()->json($category);
    }

    public function show(int $id): JsonResponse
    {
        $category = Category::findOrFail($id);

        return response()->json($category);
    }

    public function update(int $id, categoryCreateRequest $request): JsonResponse
    {
        $validated = $request->validated();

        $category = Category::find($id);
        $category->fill($validated);
        $category->save();

        return response()->json($category);
    }

    public function destroy(int $id): JsonResponse
    {
        Category::destroy($id);

        return response()->json();
    }
}
