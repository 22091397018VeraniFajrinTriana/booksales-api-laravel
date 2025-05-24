<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Pastikan user sudah login
        if (!auth()->check()) {
            return response()->json([
                'status' => 'error',
                'pesan' => 'Anda harus login terlebih dahulu'
            ], 401);
        }

        // Pastikan user memiliki role admin
        $user = auth()->user();
        
        // Asumsi field 'role' ada di tabel users atau ada method isAdmin()
        // Sesuaikan dengan struktur database Anda
        if (!$user->role || $user->role !== 'admin') {
            return response()->json([
                'status' => 'error',
                'pesan' => 'Akses ditolak. Hanya admin yang dapat mengakses endpoint ini.'
            ], 403);
        }

        return $next($request);
    }
}

/* 
|--------------------------------------------------------------------------
| Cara menggunakan middleware ini:
|--------------------------------------------------------------------------
|
| 1. Daftarkan middleware di app/Http/Kernel.php pada bagian $middlewareAliases:
|    'admin' => \App\Http\Middleware\AdminMiddleware::class,
|
| 2. Gunakan di route dengan cara:
|    Route::middleware(['auth:sanctum', 'admin'])->group(function () {
|        // Routes yang hanya bisa diakses admin
|    });
|
| 3. Atau gunakan pada controller:
|    public function __construct()
|    {
|        $this->middleware(['auth:sanctum', 'admin'])->except(['index', 'show']);
|    }
|
*/