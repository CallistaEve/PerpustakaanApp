<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Buku</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Edit Buku</h1>
        <form action="{{ route('books.update', $book->id) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Input untuk Judul Buku -->
            <div class="mb-3">
                <label for="title" class="form-label">Judul Buku</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ $book->title }}" required>
            </div>

            <!-- Input untuk Deskripsi Buku -->
            <div class="mb-3">
                <label for="description" class="form-label">Deskripsi</label>
                <textarea class="form-control" id="description" name="description">{{ $book->description }}</textarea>
            </div>

            <!-- Checklist untuk Kategori Buku -->
            <div class="mb-3">
                <label for="categories" class="form-label">Pilih Kategori</label><br>
                @foreach($categories as $category)
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="category{{ $category->id }}" name="categories[]" value="{{ $category->id }}"
                            @if(in_array($category->id, $book->categories->pluck('id')->toArray())) checked @endif>
                        <label class="form-check-label" for="category{{ $category->id }}">{{ $category->name }}</label>
                    </div>
                @endforeach
            </div>

            <button type="submit" class="btn btn-primary">Update Buku</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
