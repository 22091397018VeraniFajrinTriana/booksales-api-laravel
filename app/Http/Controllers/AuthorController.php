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


    /**
     * Tampilkan penulis berdasarkan ID.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        try {
            $author = Author::find($id);
            
            if (!$author) {
                return response()->json([
                    'status' => 'error',
                    'pesan' => 'Penulis dengan ID ' . $id . ' tidak ditemukan'
                ], 404);
            }

            return response()->json([
                'status' => 'sukses',
                'pesan' => 'Data penulis berhasil ditemukan',
                'data' => $author
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'pesan' => 'Gagal mengambil data penulis',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update penulis berdasarkan ID.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        try {
            $author = Author::find($id);
            
            if (!$author) {
                return response()->json([
                    'status' => 'error',
                    'pesan' => 'Penulis dengan ID ' . $id . ' tidak ditemukan'
                ], 404);
            }

            // Validasi data request
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:authors,email,' . $id,
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

            $author->update([
                'name' => $request->name,
                'email' => $request->email,
                'bio' => $request->bio,
                'country' => $request->country
            ]);

            return response()->json([
                'status' => 'sukses',
                'pesan' => 'Penulis berhasil diperbarui',
                'data' => $author->fresh()
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'pesan' => 'Gagal memperbarui penulis',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Hapus penulis berdasarkan ID.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        try {
            $author = Author::find($id);
            
            if (!$author) {
                return response()->json([
                    'status' => 'error',
                    'pesan' => 'Penulis dengan ID ' . $id . ' tidak ditemukan'
                ], 404);
            }

            // Cek apakah penulis masih digunakan oleh buku
            if ($author->books()->exists()) {
                return response()->json([
                    'status' => 'error',
                    'pesan' => 'Penulis tidak dapat dihapus karena masih digunakan oleh buku'
                ], 409);
            }

            $author->delete();

            return response()->json([
                'status' => 'sukses',
                'pesan' => 'Penulis berhasil dihapus'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'pesan' => 'Gagal menghapus penulis',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}