<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\SaleDetailController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\GenreController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Book routes (keep existing routes)
Route::get('/books', [BookController::class, 'index']);
Route::post('/books', [BookController::class, 'store']);
Route::get('/books/{id}', [BookController::class, 'show']);
Route::put('/books/{id}', [BookController::class, 'update']);
Route::delete('/books/{id}', [BookController::class, 'destroy']);

// Customer routes (keep existing routes)
Route::get('/customers', [CustomerController::class, 'index']);
Route::post('/customers', [CustomerController::class, 'store']);
Route::get('/customers/{id}', [CustomerController::class, 'show']);
Route::put('/customers/{id}', [CustomerController::class, 'update']);
Route::delete('/customers/{id}', [CustomerController::class, 'destroy']);

// Sale routes (keep existing routes)
Route::get('/sales', [SaleController::class, 'index']);
Route::post('/sales', [SaleController::class, 'store']);
Route::get('/sales/{id}', [SaleController::class, 'show']);
Route::put('/sales/{id}', [SaleController::class, 'update']);
Route::delete('/sales/{id}', [SaleController::class, 'destroy']);

// Sale Detail routes (keep existing routes)
Route::get('/sale-details', [SaleDetailController::class, 'index']);
Route::post('/sale-details', [SaleDetailController::class, 'store']);
Route::get('/sale-details/{id}', [SaleDetailController::class, 'show']);
Route::put('/sale-details/{id}', [SaleDetailController::class, 'update']);
Route::delete('/sale-details/{id}', [SaleDetailController::class, 'destroy']);

/*
|--------------------------------------------------------------------------
| Genre Routes with Middleware Protection
|--------------------------------------------------------------------------
*/

// Public routes untuk Genre (Read All dan Show)
Route::get('/genres', [GenreController::class, 'index']); // Dapat diakses semua orang
Route::get('/genres/{id}', [GenreController::class, 'show']); // Dapat diakses semua orang

// Protected routes untuk Genre (Create, Update, Delete) - Hanya Admin
Route::middleware(['auth:sanctum', 'admin'])->group(function () {
    Route::post('/genres', [GenreController::class, 'store']);
    Route::put('/genres/{id}', [GenreController::class, 'update']);
    Route::patch('/genres/{id}', [GenreController::class, 'update']); // Support PATCH method
    Route::delete('/genres/{id}', [GenreController::class, 'destroy']);
});

/*
|--------------------------------------------------------------------------
| Author Routes with Middleware Protection
|--------------------------------------------------------------------------
*/

// Public routes untuk Author (Read All dan Show)
Route::get('/authors', [AuthorController::class, 'index']); // Dapat diakses semua orang
Route::get('/authors/{id}', [AuthorController::class, 'show']); // Dapat diakses semua orang

// Protected routes untuk Author (Create, Update, Delete) - Hanya Admin
Route::middleware(['auth:sanctum', 'admin'])->group(function () {
    Route::post('/authors', [AuthorController::class, 'store']);
    Route::put('/authors/{id}', [AuthorController::class, 'update']);
    Route::patch('/authors/{id}', [AuthorController::class, 'update']); // Support PATCH method
    Route::delete('/authors/{id}', [AuthorController::class, 'destroy']);
});

Route::get('/test', function() {
    return response()->json(['message' => 'Test route works']);
});

/*
|--------------------------------------------------------------------------
| Route Structure Summary with Middleware
|--------------------------------------------------------------------------
|
| PUBLIC ROUTES (No Authentication Required):
| GET    /api/genres           - List all genres
| GET    /api/genres/{id}      - Show specific genre
| GET    /api/authors          - List all authors  
| GET    /api/authors/{id}     - Show specific author
|
| ADMIN ONLY ROUTES (Requires Authentication + Admin Role):
| POST   /api/genres           - Create new genre
| PUT    /api/genres/{id}      - Update genre
| PATCH  /api/genres/{id}      - Update genre (partial)
| DELETE /api/genres/{id}      - Delete genre
| POST   /api/authors          - Create new author
| PUT    /api/authors/{id}     - Update author
| PATCH  /api/authors/{id}     - Update author (partial)
| DELETE /api/authors/{id}     - Delete author
|
| Middleware yang digunakan:
| - auth:sanctum : Memastikan user sudah login/authenticated
| - admin : Memastikan user memiliki role admin
|
*/