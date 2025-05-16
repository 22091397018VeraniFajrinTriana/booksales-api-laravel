<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Penulis</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h2>Daftar Penulis</h2>
                        <a href="{{ route('authors.create') }}" class="btn btn-success">Tambah Penulis</a>
                    </div>
                    <div class="card-body">
                        @if ($message = Session::get('success'))
                            <div class="alert alert-success">
                                <p>{{ $message }}</p>
                            </div>
                        @endif
                        
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Negara</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($authors as $author)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $author->name }}</td>
                                    <td>{{ $author->email }}</td>
                                    <td>{{ $author->country }}</td>
                                    <td>
                                        <form action="{{ route('authors.destroy', $author->id) }}" method="POST">
                                            <a class="btn btn-info btn-sm" href="{{ route('authors.show', $author->id) }}">Detail</a>
                                            <a class="btn btn-primary btn-sm" href="{{ route('authors.edit', $author->id) }}">Edit</a>
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="mt-3">
                    <a href="{{ route('books.index') }}" class="btn btn-primary">Lihat Daftar Buku</a>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>