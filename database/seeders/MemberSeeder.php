<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Member;

class MemberSeeder extends Seeder
{
    public function run()
    {
        // Membuat 10 anggota dummy
        Member::factory()->count(10)->create();
    }
}

