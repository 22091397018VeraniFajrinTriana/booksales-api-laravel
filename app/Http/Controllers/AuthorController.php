<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Author;

class AuthorController extends Controller
{
    /**
     * Menampilkan daftar semua author
     */
    public function index()
    {
        $authors = Author::getAllAuthors();
        return view('author.index', compact('authors'));
    }

    /**
     * Menampilkan detail author berdasarkan ID
     */
    public function show($id)
    {
        $author = Author::getAuthorById($id);
        
        if ($author) {
            return view('author.show', compact('author'));
        } else {
            return redirect()->route('author.index')
                ->with('error', 'Author tidak ditemukan');
        }
    }
}