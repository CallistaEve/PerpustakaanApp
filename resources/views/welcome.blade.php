<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perpustakaan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h1 class="text-center">Selamat Datang di Perpustakaan</h1>

        <!-- Tombol untuk membuat Buku -->
        <div class="mb-4">
            <a href="{{ route('books.create') }}" class="btn btn-primary">Buat Buku Baru</a>
        </div>

        <!-- Tombol untuk membuat Kategori -->
        <div class="mb-4">
            <a href="{{ route('categories.create') }}" class="btn btn-primary">Buat Kategori Baru</a>
        </div>

        <!-- Tombol untuk membuat Anggota -->
        <div class="mb-4">
            <a href="{{ route('members.create') }}" class="btn btn-primary">Buat Anggota Baru</a>
        </div>

        <!-- Daftar Buku -->
        <div class="mt-4">
            <h2>Daftar Buku</h2>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Judul</th>
                        <th>Deskripsi</th>
                        <th>Kategori</th>
                        <th>Anggota</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($books->isEmpty())
                        <p>Tidak ada buku tersedia.</p>
                    @else
                        @foreach ($books as $book)
                            <tr>
                                <td>{{ $book->title }}</td>
                                <td>{{ $book->description }}</td>
                                <td>
                                    @foreach ($book->categories as $category)
                                        <span class="badge bg-secondary">{{ $category->name }}</span>
                                    @endforeach
                                </td>
                                <td>
                                    @if ($book->member)
                                        {{ $book->member->name }}
                                    @else
                                        Belum Dipinjam
                                    @endif
                                </td>
                                <td>
                                    <!-- Edit Button -->
                                    <a href="{{ route('books.edit', $book->id) }}" class="btn btn-warning btn-sm">Edit</a>

                                    <!-- Delete Button -->
                                    <form action="{{ route('books.destroy', $book->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>

        <!-- Daftar Kategori -->
        <div class="mt-4">
            <h2>Daftar Kategori</h2>
            <ul class="list-group">
                @foreach ($categories as $category)
                    <li class="list-group-item d-flex justify-content-between">
                        {{ $category->name }}
                        <!-- Tombol Edit dan Hapus Kategori -->
                        <span>
                            <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-warning btn-sm">Edit</a>

                            <form action="{{ route('categories.destroy', $category->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                            </form>
                        </span>
                    </li>
                @endforeach
            </ul>
        </div>

        <!-- Daftar Anggota -->
        <div class="mt-4">
            <h2>Daftar Anggota</h2>
            <ul class="list-group">
                @foreach ($members as $member)
                    <li class="list-group-item d-flex justify-content-between">
                        {{ $member->name }}
                        <span>
                            <a href="{{ route('members.borrowed', $member->id) }}" class="btn btn-info btn-sm">Pinjam Buku</a>

                            <!-- Tombol Edit dan Hapus Anggota -->
                            <a href="{{ route('members.edit', $member->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('members.destroy', $member->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                            </form>
                        </span>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
