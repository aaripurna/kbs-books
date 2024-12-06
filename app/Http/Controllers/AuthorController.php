<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class AuthorController extends Controller
{
    public function index(Request $request): View
    {
        $users = \App\Models\Author::query()->paginate(32);
        return view("author.index", ['users' => $users]);
    }
}
