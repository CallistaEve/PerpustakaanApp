<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buku yang Dipinjam</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Buku yang Dipinjam oleh {{ $member->name }}</h1>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- List of Borrowed Books -->
        <div class="mb-4">
            <h3>Daftar Buku yang Dipinjam</h3>
            @if ($books->isEmpty())
                <p>Tidak ada buku yang dipinjam.</p>
            @else
                <ul class="list-group">
                    @foreach ($books as $book)
                        <li class="list-group-item d-flex justify-content-between">
                            {{ $book->title }}
                            <form action="{{ route('members.release', $member->id) }}" method="POST" style="display:inline;">
                                @csrf
                                <input type="hidden" name="book_id" value="{{ $book->id }}">
                                <button type="submit" class="btn btn-danger btn-sm">Lepas Pinjaman</button>
                            </form>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>

        <!-- Form to Add a Book to Borrow -->
        <div class="mb-4">
            <h3>Pilih Buku untuk Dipinjam</h3>
            <form action="{{ route('members.books.assign', $member->id) }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="book_id" class="form-label">Pilih Buku</label>
                    <select class="form-select" name="book_id" id="book_id">
                        <option value="" selected disabled>Pilih Buku</option>
                        @foreach($availableBooks as $book)
                            <option value="{{ $book->id }}">{{ $book->title }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-success">Pinjam Buku</button>
            </form>
        </div>

        <a href="{{ route('welcome') }}" class="btn btn-primary">Kembali ke Halaman Utama</a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
