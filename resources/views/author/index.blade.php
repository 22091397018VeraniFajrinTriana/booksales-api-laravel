<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Author</title>
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

        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <h1>Daftar Author</h1>

        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Country</th>
                    <th>Birth Year</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($authors as $author)
                <tr>
                    <td>{{ $author['id'] }}</td>
                    <td>{{ $author['name'] }}</td>
                    <td>{{ $author['country'] }}</td>
                    <td>{{ $author['birth_year'] }}</td>
                    <td>
                        <a href="{{ route('author.show', $author['id']) }}" class="btn btn-sm btn-info">Detail</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>