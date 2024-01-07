<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Product_size_pivotSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('product_size_pivot')->insert([
            'product_id' => 1,
            'size_id' => 1,
            'stock' => 4,
            'created_at' => now(),
        ]);

        DB::table('product_size_pivot')->insert([
            'product_id' => 1,
            'size_id' => 2,
            'stock' => 5,
            'created_at' => now(),
        ]);

        DB::table('product_size_pivot')->insert([
            'product_id' => 1,
            'size_id' => 3,
            'stock' => 12,
            'created_at' => now(),
        ]);

        DB::table('product_size_pivot')->insert([
            'product_id' => 1,
            'size_id' => 4,
            'stock' => 5,
            'created_at' => now(),
        ]);

        DB::table('product_size_pivot')->insert([
            'product_id' => 1,
            'size_id' => 5,
            'stock' => 0,
            'created_at' => now(),
        ]);

        DB::table('product_size_pivot')->insert([
            'product_id' => 1,
            'size_id' => 6,
            'stock' => 1,
            'created_at' => now(),
        ]);

        //---------------------------------------------------------------------------------------------------------------------------------------

        DB::table('product_size_pivot')->insert([
            'product_id' => 2,
            'size_id' => 7,
            'stock' => 0,
            'created_at' => now(),
        ]);

        DB::table('product_size_pivot')->insert([
            'product_id' => 2,
            'size_id' => 8,
            'stock' => 0,
            'created_at' => now(),
        ]);

        DB::table('product_size_pivot')->insert([
            'product_id' => 2,
            'size_id' => 9,
            'stock' => 2,
            'created_at' => now(),
        ]);

        DB::table('product_size_pivot')->insert([
            'product_id' => 2,
            'size_id' => 10,
            'stock' => 4,
            'created_at' => now(),
        ]);

        DB::table('product_size_pivot')->insert([
            'product_id' => 2,
            'size_id' => 11,
            'stock' => 7,
            'created_at' => now(),
        ]);

        DB::table('product_size_pivot')->insert([
            'product_id' => 2,
            'size_id' => 12,
            'stock' => 0,
            'created_at' => now(),
        ]);

        DB::table('product_size_pivot')->insert([
            'product_id' => 2,
            'size_id' => 13,
            'stock' => 8,
            'created_at' => now(),
        ]);

        DB::table('product_size_pivot')->insert([
            'product_id' => 2,
            'size_id' => 14,
            'stock' => 3,
            'created_at' => now(),
        ]);

        DB::table('product_size_pivot')->insert([
            'product_id' => 2,
            'size_id' => 15,
            'stock' => 6,
            'created_at' => now(),
        ]);

        DB::table('product_size_pivot')->insert([
            'product_id' => 2,
            'size_id' => 16,
            'stock' => 0,
            'created_at' => now(),
        ]);

        //---------------------------------------------------------------------------------------------------------------------------------------

        DB::table('product_size_pivot')->insert([
            'product_id' => 3,
            'size_id' => 17,
            'stock' => 0,
            'created_at' => now(),
        ]);

        DB::table('product_size_pivot')->insert([
            'product_id' => 3,
            'size_id' => 18,
            'stock' => 0,
            'created_at' => now(),
        ]);

        DB::table('product_size_pivot')->insert([
            'product_id' => 3,
            'size_id' => 19,
            'stock' => 1,
            'created_at' => now(),
        ]);

        DB::table('product_size_pivot')->insert([
            'product_id' => 3,
            'size_id' => 20,
            'stock' => 4,
            'created_at' => now(),
        ]);

        DB::table('product_size_pivot')->insert([
            'product_id' => 3,
            'size_id' => 21,
            'stock' => 3,
            'created_at' => now(),
        ]);

        //---------------------------------------------------------------------------------------------------------------------------------------


        DB::table('product_size_pivot')->insert([
            'product_id' => 4,
            'size_id' => 22,
            'stock' => 0,
            'created_at' => now(),
        ]);

        DB::table('product_size_pivot')->insert([
            'product_id' => 4,
            'size_id' => 23,
            'stock' => 1,
            'created_at' => now(),
        ]);

        DB::table('product_size_pivot')->insert([
            'product_id' => 4,
            'size_id' => 24,
            'stock' => 1,
            'created_at' => now(),
        ]);

        DB::table('product_size_pivot')->insert([
            'product_id' => 4,
            'size_id' => 25,
            'stock' => 2,
            'created_at' => now(),
        ]);

        DB::table('product_size_pivot')->insert([
            'product_id' => 4,
            'size_id' => 26,
            'stock' => 0,
            'created_at' => now(),
        ]);

        //---------------------------------------------------------------------------------------------------------------------------------------

        DB::table('product_size_pivot')->insert([
            'product_id' => 5,
            'size_id' => 27,
            'stock' => 0,
            'created_at' => now(),
        ]);

        DB::table('product_size_pivot')->insert([
            'product_id' => 5,
            'size_id' => 28,
            'stock' => 7,
            'created_at' => now(),
        ]);

        DB::table('product_size_pivot')->insert([
            'product_id' => 5,
            'size_id' => 29,
            'stock' => 2,
            'created_at' => now(),
        ]);

        DB::table('product_size_pivot')->insert([
            'product_id' => 5,
            'size_id' => 30,
            'stock' => 4,
            'created_at' => now(),
        ]);

        DB::table('product_size_pivot')->insert([
            'product_id' => 5,
            'size_id' => 31,
            'stock' => 1,
            'created_at' => now(),
        ]);
        
        //---------------------------------------------------------------------------------------------------------------------------------------

        DB::table('product_size_pivot')->insert([
            'product_id' => 6,
            'size_id' => 32,
            'stock' => 1,
            'created_at' => now(),
        ]);

        DB::table('product_size_pivot')->insert([
            'product_id' => 6,
            'size_id' => 33,
            'stock' => 0,
            'created_at' => now(),
        ]);

        DB::table('product_size_pivot')->insert([
            'product_id' => 6,
            'size_id' => 34,
            'stock' => 2,
            'created_at' => now(),
        ]);

        DB::table('product_size_pivot')->insert([
            'product_id' => 6,
            'size_id' => 35,
            'stock' => 4,
            'created_at' => now(),
        ]);

        DB::table('product_size_pivot')->insert([
            'product_id' => 6,
            'size_id' => 36,
            'stock' => 5,
            'created_at' => now(),
        ]);
    }
}
