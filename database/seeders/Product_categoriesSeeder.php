<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Product_categoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('product_categories')->insert([
            'name' => 'T-shirts',
            'created_at' => now(),
        ]);

        DB::table('product_categories')->insert([
            'name' => 'Truien',
            'pin' => now(),
            'created_at' => now(),
        ]);

        DB::table('product_categories')->insert([
            'name' => 'Broeken',
            'created_at' => now(),
        ]);
    }
}
