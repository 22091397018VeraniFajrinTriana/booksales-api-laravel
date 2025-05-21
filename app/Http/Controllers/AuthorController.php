<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuthorController extends Controller
{
    /**
     * Tampilkan semua data penulis.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $authors = Author::all();
        
        return response()->json([
            'status' => 'sukses',
            'pesan' => 'Semua data penulis berhasil diambil',
            'data' => $authors
        ], 200);
    }

    /**
     * Simpan penulis baru ke dalam database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        // Validasi data request
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:authors,email',
            'bio' => 'nullable|string',
            'country' => 'nullable|string|max:255'
        ]);

        // Kembalikan error jika validasi gagal
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'pesan' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        // Buat penulis baru
        $author = Author::create([
            'name' => $request->name,
            'email' => $request->email,
            'bio' => $request->bio,
            'country' => $request->country
        ]);

        // Kembalikan respons sukses
        return response()->json([
            'status' => 'sukses',
            'pesan' => 'Penulis berhasil dibuat',
            'data' => $author
        ], 201);
    }
}