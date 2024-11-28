<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = now();
        DB::table('categories')->insert([
            'name' => 'Novel',
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        DB::table('categories')->insert([
            'name' => 'Komik',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('categories')->insert([
            'name' => 'Fiksi',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('categories')->insert([
            'name' => 'Sejarah',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
    }
}
