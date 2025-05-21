<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GenreController extends Controller
{
    /**
     * Tampilkan semua data genre.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $genres = Genre::all();
        
        return response()->json([
            'status' => 'sukses',
            'pesan' => 'Semua data genre berhasil diambil',
            'data' => $genres
        ], 200);
    }

    /**
     * Simpan genre baru ke dalam database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        // Validasi data request
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:genres',
        ]);

        // Kembalikan error jika validasi gagal
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'pesan' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        // Buat genre baru
        $genre = Genre::create([
            'name' => $request->name,
        ]);

        // Kembalikan respons sukses
        return response()->json([
            'status' => 'sukses',
            'pesan' => 'Genre berhasil dibuat',
            'data' => $genre
        ], 201);
    }
}