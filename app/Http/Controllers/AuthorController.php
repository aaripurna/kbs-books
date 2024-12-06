<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Http\Requests\AuthorCreateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;

class AuthorController extends Controller
{
    public function index(Request $request): View
    {
        $users = \App\Models\Author::query()->paginate(32);
        return view("author.index", ['users' => $users]);
    }

    public function create(Request $request): View
    {
        $author = new \App\Models\Author();
        return view("author.create", ['author' => $author]);
    }

    public function store(AuthorCreateRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        \App\Models\Author::create($validated);

        return Redirect::route('authors.index');
    }

    public function edit(int $id): View
    {
        $author = \App\Models\Author::find($id);

        return view("author.edit", ["author" => $author]);
    }

    public function update(int $id, AuthorCreateRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $author = \App\Models\Author::find($id);
        $author->fill($validated);
        $author->save();

        return Redirect::route('authors.index');
    }

    public function destroy(int $id): RedirectResponse
    {
        \App\Models\Author::destroy($id);
        return Redirect::route('authors.index');
    }
}
