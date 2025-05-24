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


    /**
     * Tampilkan genre berdasarkan ID.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        try {
            $genre = Genre::find($id);
            
            if (!$genre) {
                return response()->json([
                    'status' => 'error',
                    'pesan' => 'Genre dengan ID ' . $id . ' tidak ditemukan'
                ], 404);
            }

            return response()->json([
                'status' => 'sukses',
                'pesan' => 'Data genre berhasil ditemukan',
                'data' => $genre
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'pesan' => 'Gagal mengambil data genre',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update genre berdasarkan ID.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        try {
            $genre = Genre::find($id);
            
            if (!$genre) {
                return response()->json([
                    'status' => 'error',
                    'pesan' => 'Genre dengan ID ' . $id . ' tidak ditemukan'
                ], 404);
            }

            // Validasi data request
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255|unique:genres,name,' . $id,
            ]);

            // Kembalikan error jika validasi gagal
            if ($validator->fails()) {
                return response()->json([
                    'status' => 'error',
                    'pesan' => 'Validasi gagal',
                    'errors' => $validator->errors()
                ], 422);
            }

            $genre->update([
                'name' => $request->name,
            ]);

            return response()->json([
                'status' => 'sukses',
                'pesan' => 'Genre berhasil diperbarui',
                'data' => $genre->fresh()
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'pesan' => 'Gagal memperbarui genre',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Hapus genre berdasarkan ID.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        try {
            $genre = Genre::find($id);
            
            if (!$genre) {
                return response()->json([
                    'status' => 'error',
                    'pesan' => 'Genre dengan ID ' . $id . ' tidak ditemukan'
                ], 404);
            }

            // Cek apakah genre masih digunakan oleh buku
            if ($genre->books()->exists()) {
                return response()->json([
                    'status' => 'error',
                    'pesan' => 'Genre tidak dapat dihapus karena masih digunakan oleh buku'
                ], 409);
            }

            $genre->delete();

            return response()->json([
                'status' => 'sukses',
                'pesan' => 'Genre berhasil dihapus'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'pesan' => 'Gagal menghapus genre',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}