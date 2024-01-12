<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            Size_sortSeeder::class,
            SizeSeeder::class,
            Product_categoriesSeeder::class,
            ProductSeeder::class,
            Product_size_pivotSeeder::class,
            NieuwsSeeder::class,
            Faq_categoriesSeeder::class,
            FaqSeeder::class,
            Contact_formSeeder::class,
            OrderSeeder::class,
            Order_productsSeeder::class,
        ]);
    }
}
