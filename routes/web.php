<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\AuthorController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return redirect()->route('genre.index');
});

// Route untuk Genre
Route::get('/genres', [GenreController::class, 'index'])->name('genre.index');
Route::get('/genres/{id}', [GenreController::class, 'show'])->name('genre.show');

// Route untuk Author
Route::get('/authors', [AuthorController::class, 'index'])->name('author.index');
Route::get('/authors/{id}', [AuthorController::class, 'show'])->name('author.show');