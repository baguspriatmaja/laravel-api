<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = now();
        DB::table('products')->insert([
            'name' => 'Produk A',
            'category_id' => '1',
            'brand_id' => '1',
            'price' => 100,
            'stock' => 50,
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        DB::table('products')->insert([
            'name' => 'Produk B',
            'category_id' => '2',
            'brand_id' => '2',
            'price' => 150,
            'stock' => 30,
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('products')->insert([
            'name' => 'Produk C',
            'category_id' => '3',
            'brand_id' => '3',
            'price' => 100,
            'stock' => 10,
            'created_at' => $now,
            'updated_at' => $now,
        ]);
    }
}
