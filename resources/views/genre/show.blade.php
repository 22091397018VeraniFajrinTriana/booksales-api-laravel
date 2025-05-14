<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Genre</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <nav class="navbar navbar-expand-lg navbar-light bg-light mb-4">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Tugas Veryn</a>
                <div class="collapse navbar-collapse">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('genre.index') }}">Genres</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('author.index') }}">Authors</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="card">
            <div class="card-header">
                <h1>Detail Genre</h1>
            </div>
            <div class="card-body">
                <h2>{{ $genre['name'] }}</h2>
                <p><strong>ID:</strong> {{ $genre['id'] }}</p>
                <p><strong>Description:</strong> {{ $genre['description'] }}</p>
            </div>
            <div class="card-footer">
                <a href="{{ route('genre.index') }}" class="btn btn-primary">Back to List</a>
            </div>
        </div>
    </div>
</body>
</html>