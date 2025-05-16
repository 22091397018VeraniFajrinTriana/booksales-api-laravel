<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Buku</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h2>Detail Buku</h2>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <dl class="row">
                                    <dt class="col-sm-4">Judul</dt>
                                    <dd class="col-sm-8">{{ $book->title }}</dd>
                                    
                                    <dt class="col-sm-4">Penulis</dt>
                                    <dd class="col-sm-8">{{ $book->author->name }}</dd>
                                    
                                    <dt class="col-sm-4">ISBN</dt>
                                    <dd class="col-sm-8">{{ $book->isbn }}</dd>
                                    
                                    <dt class="col-sm-4">Genre</dt>
                                    <dd class="col-sm-8">{{ $book->genre }}</dd>
                                    
                                    <dt class="col-sm-4">Harga</dt>
                                    <dd class="col-sm-8">Rp {{ number_format($book->price, 0, ',', '.') }}</dd>
                                </dl>
                            </div>
                            <div class="col-md-6">
                                <dl class="row">
                                    <dt class="col-sm-4">Publisher</dt>
                                    <dd class="col-sm-8">{{ $book->publisher }}</dd>
                                    
                                    <dt class="col-sm-4">Tanggal Terbit</dt>
                                    <dd class="col-sm-8">{{ date('d F Y', strtotime($book->published_date)) }}</dd>
                                    
                                    <dt class="col-sm-4">Jumlah Halaman</dt>
                                    <dd class="col-sm-8">{{ $book->page_count }}</dd>
                                </dl>
                            </div>
                        </div>
                        
                        <h4 class="mt-4">Deskripsi</h4>
                        <p>{{ $book->description }}</p>
                        
                        <div class="mt-4">
                            <a href="{{ route('books.index') }}" class="btn btn-secondary">Kembali</a>
                            <a href="{{ route('books.edit', $book->id) }}" class="btn btn-primary">Edit</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>