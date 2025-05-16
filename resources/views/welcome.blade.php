<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Sales API</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .welcome-container {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            padding: 20px;
        }
        .card {
            border-radius: 10px;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
            padding: 20px;
            background-color: white;
            max-width: 800px;
            width: 100%;
        }
        .app-title {
            font-size: 2.5rem;
            font-weight: bold;
            margin-bottom: 20px;
            color: #343a40;
        }
        .button-container {
            margin-top: 30px;
        }
        .btn {
            margin: 10px;
            padding: 12px 30px;
            font-size: 1.2rem;
            border-radius: 50px;
        }
    </style>
</head>
<body>
    <div class="welcome-container">
        <div class="card">
            <h1 class="app-title">Book Sales API</h1>
            <p class="lead">Selamat datang di aplikasi Book Sales API. Aplikasi ini menyediakan pengelolaan data buku dan penulis.</p>
            
            <div class="button-container">
                <a href="{{ route('books.index') }}" class="btn btn-primary">Lihat Daftar Buku</a>
                <a href="{{ route('authors.index') }}" class="btn btn-success">Lihat Daftar Penulis</a>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>