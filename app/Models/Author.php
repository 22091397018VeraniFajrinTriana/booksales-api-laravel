<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    use HasFactory;

    // Mendefinisikan properti author
    protected $fillable = ['name', 'country', 'birth_year'];
    
    // Method untuk mendapatkan semua author
    public static function getAllAuthors()
    {
        return [
            [
                'id' => 1,
                'name' => 'J.K. Rowling',
                'country' => 'United Kingdom',
                'birth_year' => 1965
            ],
            [
                'id' => 2,
                'name' => 'Stephen King',
                'country' => 'United States',
                'birth_year' => 1947
            ],
            [
                'id' => 3,
                'name' => 'Haruki Murakami',
                'country' => 'Japan',
                'birth_year' => 1949
            ],
            [
                'id' => 4,
                'name' => 'Gabriel García Márquez',
                'country' => 'Colombia',
                'birth_year' => 1927
            ],
            [
                'id' => 5,
                'name' => 'Chimamanda Ngozi Adichie',
                'country' => 'Nigeria',
                'birth_year' => 1977
            ]
        ];
    }

    // Method untuk mendapatkan author berdasarkan ID
    public static function getAuthorById($id)
    {
        $authors = self::getAllAuthors();
        foreach ($authors as $author) {
            if ($author['id'] == $id) {
                return $author;
            }
        }
        return null;
    }
}