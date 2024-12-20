<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',           // Nama kategori
    ];
    
    public function books()
    {
        return $this->hasMany(Book::class, 'member_id');
    }
}
