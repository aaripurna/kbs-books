<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Http\Requests\CategoryCreateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;

class CategoryController extends Controller
{
    public function index(Request $request): View
    {
        $categories = \App\Models\Category::query()->paginate(32);
        return view("category.index", ['categories' => $categories]);
    }

    public function create(Request $request): View
    {
        $category = new \App\Models\Category();
        return view("category.create", ['category' => $category]);
    }

    public function store(categoryCreateRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        \App\Models\category::create($validated);

        return Redirect::route('categories.index');
    }

    public function edit(int $id): View
    {
        $category = \App\Models\Category::find($id);

        return view("category.edit", ["category" => $category]);
    }

    public function update(int $id, categoryCreateRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $category = \App\Models\Category::find($id);
        $category->fill($validated);
        $category->save();

        return Redirect::route('categories.index');
    }

    public function destroy(int $id): RedirectResponse
    {
        \App\Models\category::destroy($id);
        return Redirect::route('categories.index');
    }
}
