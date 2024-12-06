<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\BookCreateRequest;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class BookController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $categories = Book::query()->paginate(32);

        return response()->json($categories);
    }

    public function store(BookCreateRequest $request): JsonResponse
    {
        $validated = $request->validated();

        $category = Book::create($validated);

        return response()->json($category);
    }

    public function show(int $id): JsonResponse
    {
        $category = Book::findOrFail($id);

        return response()->json($category);
    }

    public function update(int $id, BookCreateRequest $request): JsonResponse
    {
        $validated = $request->validated();

        $category = Book::findOrFail($id);
        $category->fill($validated);
        $category->save();

        return response()->json($category);
    }

    public function destroy(int $id): JsonResponse
    {
        Book::destroy($id);

        return response()->json();
    }
}
