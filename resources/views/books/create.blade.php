<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Buku</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h2>Tambah Buku Baru</h2>
                    </div>
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <strong>Error!</strong> Ada masalah dengan input Anda.<br><br>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        
                        <form action="{{ route('books.store') }}" method="POST">
                            @csrf
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="title">Judul Buku:</label>
                                        <input type="text" name="title" id="title" class="form-control" placeholder="Masukkan judul buku" value="{{ old('title') }}" required>
                                    </div>
                                    
                                    <div class="form-group mb-3">
                                        <label for="author_id">Penulis:</label>
                                        <select name="author_id" id="author_id" class="form-control" required>
                                            <option value="">-- Pilih Penulis --</option>
                                            @foreach($authors as $author)
                                                <option value="{{ $author->id }}" {{ old('author_id') == $author->id ? 'selected' : '' }}>{{ $author->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    
                                    <div class="form-group mb-3">
                                        <label for="isbn">ISBN:</label>
                                        <input type="text" name="isbn" id="isbn" class="form-control" placeholder="Masukkan ISBN" value="{{ old('isbn') }}" required>
                                    </div>
                                    
                                    <div class="form-group mb-3">
                                        <label for="published_date">Tanggal Terbit:</label>
                                        <input type="date" name="published_date" id="published_date" class="form-control" value="{{ old('published_date') }}" required>
                                    </div>
                                    
                                    <div class="form-group mb-3">
                                        <label for="publisher">Penerbit:</label>
                                        <input type="text" name="publisher" id="publisher" class="form-control" placeholder="Masukkan nama penerbit" value="{{ old('publisher') }}" required>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="genre">Genre:</label>
                                        <input type="text" name="genre" id="genre" class="form-control" placeholder="Masukkan genre" value="{{ old('genre') }}" required>
                                    </div>
                                    
                                    <div class="form-group mb-3">
                                        <label for="page_count">Jumlah Halaman:</label>
                                        <input type="number" name="page_count" id="page_count" class="form-control" placeholder="Masukkan jumlah halaman" value="{{ old('page_count') }}" required>
                                    </div>
                                    
                                    <div class="form-group mb-3">
                                        <label for="price">Harga (Rp):</label>
                                        <input type="number" name="price" id="price" class="form-control" placeholder="Masukkan harga" value="{{ old('price') }}" required>
                                    </div>
                                    
                                    <div class="form-group mb-3">
                                        <label for="description">Deskripsi:</label>
                                        <textarea name="description" id="description" class="form-control" rows="4" placeholder="Masukkan deskripsi buku">{{ old('description') }}</textarea>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-xs-12 mt-3">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                                <a href="{{ route('books.index') }}" class="btn btn-secondary">Batal</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>