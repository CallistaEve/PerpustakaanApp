<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'description'];

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'book_category');
    }

    public function show($id)
{
    $book = Book::with('categories')->findOrFail($id);
    return view('books.show', compact('book'));
}


    // Relasi One-to-Many dengan Member
    public function member()
    {
        return $this->belongsTo(Member::class, 'member_id');
    }
}
