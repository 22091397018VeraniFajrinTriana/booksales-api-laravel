<?php

require_once 'app/models/Genre.php';

class GenreController {
    private $genreModel;

    public function __construct() {
        $this->genreModel = new Genre();
    }

    public function index() {
        $genres = $this->genreModel->getAllGenres();
        
        // Memuat view
        include 'app/views/genre/index.php';
    }

    public function show($id) {
        $genre = $this->genreModel->getGenreById($id);
        
        if ($genre) {
            // Memuat view detail
            include 'app/views/genre/show.php';
        } else {
            // Handle error jika genre tidak ditemukan
            echo "Genre not found";
        }
    }
}