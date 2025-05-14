<?php

require_once 'app/models/Author.php';

class AuthorController {
    private $authorModel;

    public function __construct() {
        $this->authorModel = new Author();
    }

    public function index() {
        $authors = $this->authorModel->getAllAuthors();
        
        // Memuat view
        include 'app/views/author/index.php';
    }

    public function show($id) {
        $author = $this->authorModel->getAuthorById($id);
        
        if ($author) {
            // Memuat view detail
            include 'app/views/author/show.php';
        } else {
            // Handle error jika author tidak ditemukan
            echo "Author not found";
        }
    }
}