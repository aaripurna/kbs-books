<?php

use App\Http\Controllers\Api\V1\AuthorController;
use App\Http\Controllers\Api\V1\BookController;
use App\Http\Controllers\Api\V1\CategoryController;
use Illuminate\Support\Facades\Route;


Route::prefix("v1")->group(function () {
    Route::resource("categories", CategoryController::class);
    Route::resource("authors", AuthorController::class);
    Route::resource("books", BookController::class);
});
