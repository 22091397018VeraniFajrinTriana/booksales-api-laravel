<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    use HasFactory;

    // Mendefinisikan properti genre
    protected $fillable = ['name', 'description'];
    
    // Method untuk mendapatkan semua genre
    public static function getAllGenres()
    {
        return [
            [
                'id' => 1,
                'name' => 'Science Fiction',
                'description' => 'Fiksi ilmiah yang berbasis pada penemuan ilmiah atau teknologi canggih'
            ],
            [
                'id' => 2,
                'name' => 'Fantasy',
                'description' => 'Fiksi fantasi yang menampilkan unsur magis dan makhluk legenda'
            ],
            [
                'id' => 3,
                'name' => 'Mystery',
                'description' => 'Fiksi detektif yang berfokus pada pemecahan kasus kejahatan atau misteri'
            ],
            [
                'id' => 4,
                'name' => 'Romance',
                'description' => 'Fiksi romantis yang mengisahkan hubungan cinta antara karakter'
            ],
            [
                'id' => 5,
                'name' => 'Horror',
                'description' => 'Fiksi horor yang bertujuan untuk membuat pembaca merasa takut atau ngeri'
            ]
        ];
    }

    // Method untuk mendapatkan genre berdasarkan ID
    public static function getGenreById($id)
    {
        $genres = self::getAllGenres();
        foreach ($genres as $genre) {
            if ($genre['id'] == $id) {
                return $genre;
            }
        }
        return null;
    }
}