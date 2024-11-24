<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Book;
use App\Models\Category;
use App\Models\Member;

class BookSeeder extends Seeder
{
    public function run()
    {
        // Membuat 10 buku dummy
        Book::factory()->count(10)->create()->each(function ($book) {
            // Mengaitkan kategori secara acak (many-to-many)
            $categories = Category::inRandomOrder()->take(2)->pluck('id');
            $book->categories()->attach($categories);

            // Mengaitkan anggota secara acak (one-to-many)
            $book->member()->associate(Member::inRandomOrder()->first())->save();
        });
    }
}
