<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookCreateRequest;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;

class BookController extends Controller
{
    public function index(Request $request): View
    {
        $sortDir = $request->get("dir", "asc");

        if (!in_array(strtolower($sortDir), ["asc", "desc"])) {
            $sortDir = "asc";
        }

        $books = Book::query()->with('author')->with('category')->orderBy('title', $sortDir)->paginate(250);
        return view("book.index", ['books' => $books]);
    }

    public function create(Request $request): View
    {
        $book = new Book();
        $categories = Category::query()->get();
        $authors = Author::query()->get();
        return view("book.create", ['book' => $book, 'categories' => $categories, 'authors' => $authors]);
    }

    public function store(BookCreateRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $book = Book::create($validated);

        return Redirect::route('books.show', ['book' => $book]);
    }

    public function show(int $id): View
    {
        $book = Book::with('author')->with('category')->find($id);
        return view("book.show", ['book' => $book]);
    }

    public function edit(int $id): View
    {
        $book = Book::find($id);
        $categories = Category::query()->get();
        $authors = Author::query()->get();

        return view("book.edit", ['book' => $book, 'categories' => $categories, 'authors' => $authors]);
    }

    public function update(int $id, BookCreateRequest $request): View
    {
        $validated = $request->validated();

        $book = Book::find($id);
        $book->fill($validated);
        $book->save();

        return view("book.show", ['book' => $book]);
    }

    public function destroy(int $id): RedirectResponse
    {
        Book::destroy($id);
        return Redirect::route('books.index');
    }
}
