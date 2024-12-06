<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthorCreateRequest;
use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class AuthorController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $categories = Author::query()->paginate(32);

        return response()->json($categories);
    }

    public function store(AuthorCreateRequest $request): JsonResponse
    {
        $validated = $request->validated();

        $category = Author::create($validated);

        return response()->json($category);
    }

    public function show(int $id): JsonResponse
    {
        $category = Author::findOrFail($id);

        return response()->json($category);
    }

    public function update(int $id, AuthorCreateRequest $request): JsonResponse
    {
        $validated = $request->validated();

        $category = Author::findOrFail($id);
        $category->fill($validated);
        $category->save();

        return response()->json($category);
    }

    public function destroy(int $id): JsonResponse
    {
        Author::destroy($id);

        return response()->json();
    }
}
