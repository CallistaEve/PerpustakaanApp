<?php

namespace Database\Factories;

use App\Models\Book;
use App\Models\Category;
use App\Models\Member;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookFactory extends Factory
{
    protected $model = Book::class;

    public function definition()
    {
        return [
            'title' => $this->faker->word(),
            'description' => $this->faker->sentence(),
            'member_id' => Member::inRandomOrder()->first()->id,  // Relasi dengan anggota
        ];
    }
}

