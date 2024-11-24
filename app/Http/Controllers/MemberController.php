<?php

namespace App\Http\Controllers;
use App\Models\Member;

use Illuminate\Http\Request;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $members = Member::all();

        return view('members.index', compact('members'));
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
}
