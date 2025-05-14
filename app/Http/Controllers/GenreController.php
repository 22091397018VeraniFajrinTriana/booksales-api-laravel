<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Genre;

class GenreController extends Controller
{
    /**
     * Menampilkan daftar semua genre
     */
    public function index()
    {
        $genres = Genre::getAllGenres();
        return view('genre.index', compact('genres'));
    }

    /**
     * Menampilkan detail genre berdasarkan ID
     */
    public function show($id)
    {
        $genre = Genre::getGenreById($id);
        
        if ($genre) {
            return view('genre.show', compact('genre'));
        } else {
            return redirect()->route('genre.index')
                ->with('error', 'Genre tidak ditemukan');
        }
    }
}