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

// API Resource Routes untuk Genre (menggantikan routes manual)
Route::apiResource('genres', GenreController::class);

// API Resource Routes untuk Author (menggantikan routes manual)
Route::apiResource('authors', AuthorController::class);

Route::get('/test', function() {
    return response()->json(['message' => 'Test route works']);
});

/*
|--------------------------------------------------------------------------
| Route API Resource akan menghasilkan endpoint berikut:
|--------------------------------------------------------------------------
|
| Verb      URI                    Action       Route Name
| GET       /api/genres            index        genres.index
| POST      /api/genres            store        genres.store
| GET       /api/genres/{id}       show         genres.show
| PUT/PATCH /api/genres/{id}       update       genres.update
| DELETE    /api/genres/{id}       destroy      genres.destroy
|
| GET       /api/authors           index        authors.index
| POST      /api/authors           store        authors.store
| GET       /api/authors/{id}      show         authors.show
| PUT/PATCH /api/authors/{id}      update       authors.update
| DELETE    /api/authors/{id}      destroy      authors.destroy
|
*/