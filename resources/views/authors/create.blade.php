<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Penulis</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h2>Tambah Penulis Baru</h2>
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
                        
                        <form action="{{ route('authors.store') }}" method="POST">
                            @csrf
                            
                            <div class="form-group mb-3">
                                <label for="name">Nama Penulis:</label>
                                <input type="text" name="name" id="name" class="form-control" placeholder="Masukkan nama penulis" value="{{ old('name') }}" required>
                            </div>
                            
                            <div class="form-group mb-3">
                                <label for="email">Email:</label>
                                <input type="email" name="email" id="email" class="form-control" placeholder="Masukkan email" value="{{ old('email') }}" required>
                            </div>
                            
                            <div class="form-group mb-3">
                                <label for="bio">Biografi:</label>
                                <textarea name="bio" id="bio" class="form-control" rows="4" placeholder="Masukkan biografi penulis">{{ old('bio') }}</textarea>
                            </div>
                            
                            <div class="form-group mb-3">
                                <label for="country">Negara:</label>
                                <input type="text" name="country" id="country" class="form-control" placeholder="Masukkan negara asal" value="{{ old('country') }}">
                            </div>
                            
                            <div class="mt-3">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                                <a href="{{ route('authors.index') }}" class="btn btn-secondary">Batal</a>
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