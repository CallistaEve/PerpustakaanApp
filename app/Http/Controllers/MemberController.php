<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Book;

use Illuminate\Http\Request;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $members = Member::all();

        return view('welcome', compact('members'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('members.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input dari form
        $request->validate([
            'name' => 'required|max:255',
        ]);

        // Simpan anggota baru ke database
        Member::create([
            'name' => $request->input('name'),
        ]);

        // Redirect ke halaman daftar anggota setelah berhasil
        return redirect('/')->with('success', 'Anggota berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Cari anggota berdasarkan ID
        $member = Member::findOrFail($id);

        // Tampilkan detail anggota
        return view('members.show', compact('member'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Member $member)
    {
        return view('members.edit', compact('member'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Member $member)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $member->update([
            'name' => $request->input('name'),
        ]);

        return redirect('/')->with('success', 'Anggota berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Member $member)
    {
        $member->delete();
        return redirect('/')->with('success', 'Anggota berhasil dihapus!');
    }

    public function borrowedBooks($id)
    {
        $member = Member::with('books')->findOrFail($id); // Get member with borrowed books
        $books = $member->books; // Books borrowed by the member

        // Get the available books (those not yet borrowed by any member)
        $availableBooks = Book::whereNull('member_id')->get();
        return view('members.borrowed', compact('member', 'books', 'availableBooks'));
    }

    public function assignBook(Request $request, $id)
    {
        $member = Member::findOrFail($id);
        $bookId = $request->input('book_id');
        $book = Book::findOrFail($bookId);

        // Assign the book to the member
        if (!$book->member_id) {
            $book->member_id = $member->id;
            $book->save();

            return redirect()->route('members.borrowed', $member->id)->with('success', 'Buku berhasil dipinjam!');
        }

        return redirect()->route('members.borrowed', $member->id)->with('error', 'Buku sudah dipinjam.');
    }



    public function releaseBook(Request $request, $id)
    {
        $member = Member::findOrFail($id);
        $bookId = $request->input('book_id');
        $book = Book::findOrFail($bookId);

        if ($book->member_id == $member->id) {
            $book->member_id = null; // Lepas pinjaman
            $book->save();
        }
        return redirect()->route('members.borrowed', $member->id)->with('error', 'Buku sudah dipinjam.');
    }
}
