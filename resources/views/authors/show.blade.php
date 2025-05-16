<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Penulis</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h2>Detail Penulis</h2>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <dl class="row">
                                    <dt class="col-sm-4">Nama</dt>
                                    <dd class="col-sm-8">{{ $author->name }}</dd>
                                    
                                    <dt class="col-sm-4">Email</dt>
                                    <dd class="col-sm-8">{{ $author->email }}</dd>
                                    
                                    <dt class="col-sm-4">Negara</dt>
                                    <dd class="col-sm-8">{{ $author->country }}</dd>
                                </dl>
                            </div>
                        </div>
                        
                        <h4 class="mt-4">Biografi</h4>
                        <p>{{ $author->bio }}</p>
                        
                        <h4 class="mt-4">Buku yang Ditulis</h4>
                        @if($author->books->count() > 0)
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Judul</th>
                                        <th>Genre</th>
                                        <th>Publisher</th>
                                        <th>Harga</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($author->books as $index => $book)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $book->title }}</td>
                                        <td>{{ $book->genre }}</td>
                                        <td>{{ $book->publisher }}</td>
                                        <td>Rp {{ number_format($book->price, 0, ',', '.') }}</td>
                                        <td>
                                            <a href="{{ route('books.show', $book->id) }}" class="btn btn-info btn-sm">Detail</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <p>Penulis ini belum memiliki buku.</p>
                        @endif
                        
                        <div class="mt-4">
                            <a href="{{ route('authors.index') }}" class="btn btn-secondary">Kembali</a>
                            <a href="{{ route('authors.edit', $author->id) }}" class="btn btn-primary">Edit</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>