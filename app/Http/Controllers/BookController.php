<?php

namespace App\Http\Controllers;
use App\Models\Book;
use App\Models\Category;
use App\Models\Member;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Mengambil data buku beserta kategori dan anggota
        $books = Book::with('categories', 'member')->get();
        $categories = Category::all(); // Jika perlu mengirim kategori juga
        $members = Member::all(); // Jika perlu mengirim anggota juga

        // Mengirimkan data buku, kategori, dan anggota ke view
        return view('welcome', compact('books', 'categories', 'members'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
         // Ambil semua kategori yang ada
         $categories = Category::all();

         return view('books.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    // Validasi inputan
    $request->validate([
        'title' => 'required|max:255',
        'description' => 'nullable|string',
        'categories' => 'required|array',  // Validasi kategori yang dipilih
    ]);

    // Simpan data buku
    $book = Book::create([
        'title' => $request->input('title'),
        'description' => $request->input('description'),
    ]);

    // Hubungkan buku dengan kategori yang dipilih
    $book->categories()->attach($request->input('categories'));

    // Redirect ke halaman lain setelah sukses
    return redirect('/')->with('success', 'Buku berhasil ditambahkan!');
}


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $book = Book::findOrFail($id);  // Jika tidak ditemukan, akan otomatis mengembalikan error 404

        return view('books.show', compact('book'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book)
{
    $categories = Category::all();
    return view('books.edit', compact('book', 'categories'));
}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Book $book)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'nullable|string',
        'categories' => 'required|array',
    ]);

    $book->update([
        'title' => $request->input('title'),
        'description' => $request->input('description'),
    ]);

    // Mengupdate relasi buku dengan kategori
    $book->categories()->sync($request->input('categories'));

    return redirect('/')->with('success', 'Buku berhasil diubah!');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
{
    $book->delete();
    return redirect('/')->with('success', 'Buku berhasil dihapus!');
}
}
