<?php

namespace Database\Seeders;

use App\Models\Book;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Book::create([
            'title' => 'Laskar Pelangi',
            'author_id' => 1,
            'description' => 'Kisah perjuangan anak-anak untuk mendapatkan pendidikan di Belitung',
            'isbn' => '9789792248616',
            'page_count' => 529,
            'price' => 98000,
            'published_date' => '2005-01-01',
            'publisher' => 'Bentang Pustaka',
            'genre' => 'Novel'
        ]);

        Book::create([
            'title' => 'Bumi Manusia',
            'author_id' => 4,
            'description' => 'Novel sejarah pertama dari Tetralogi Buru',
            'isbn' => '9799731234',
            'page_count' => 535,
            'price' => 120000,
            'published_date' => '1980-08-25',
            'publisher' => 'Hasta Mitra',
            'genre' => 'Historical Fiction'
        ]);

        Book::create([
            'title' => 'Hujan',
            'author_id' => 2,
            'description' => 'Kisah persahabatan dan percintaan masa SMA',
            'isbn' => '9786020822129',
            'page_count' => 320,
            'price' => 89000,
            'published_date' => '2016-01-01',
            'publisher' => 'Gramedia Pustaka Utama',
            'genre' => 'Novel'
        ]);

        Book::create([
            'title' => 'Supernova: Kesatria, Putri, dan Bintang Jatuh',
            'author_id' => 3,
            'description' => 'Pertemuan takdir dari enam karakter berbeda',
            'isbn' => '9799736451',
            'page_count' => 278,
            'price' => 85000,
            'published_date' => '2001-02-01',
            'publisher' => 'Truedee Books',
            'genre' => 'Novel'
        ]);

        Book::create([
            'title' => 'Cantik Itu Luka',
            'author_id' => 5,
            'description' => 'Kisah epik yang mencampurkan sejarah, tragedi keluarga, dan folklore',
            'isbn' => '9786022913177',
            'page_count' => 537,
            'price' => 125000,
            'published_date' => '2002-01-01',
            'publisher' => 'Gramedia Pustaka Utama',
            'genre' => 'Novel'
        ]);
    }
}