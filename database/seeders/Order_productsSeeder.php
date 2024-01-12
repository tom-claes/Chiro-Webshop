<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Order_productsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('order_products')->insert([
            'order_nr' => 'Xe6ZOaItRp',
            'product_id' => 1,
            'size_id' => 1,
            'quantity' => 1,
            'created_at' => now(),
        ]);

        DB::table('order_products')->insert([
            'order_nr' => 'Xe6ZOaItRp',
            'product_id' => 3,
            'size_id' => 17,
            'quantity' => 2,
            'created_at' => now(),
        ]);

        DB::table('order_products')->insert([
            'order_nr' => 'Xe6ZOaItRp',
            'product_id' => 4,
            'size_id' => 23,
            'quantity' => 1,
            'created_at' => now(),
        ]);

        DB::table('order_products')->insert([
            'order_nr' => 'Xe6ZOaItRp',
            'product_id' => 5,
            'size_id' => 27,
            'quantity' => 1,
            'created_at' => now(),
        ]);

        //---------------------------------------------------------------------------------------------------------------------------------------

        DB::table('order_products')->insert([
            'order_nr' => '5NsJRh81bW',
            'product_id' => 6,
            'size_id' => 36,
            'quantity' => 1,
            'created_at' => now(),
        ]);

        //---------------------------------------------------------------------------------------------------------------------------------------

        DB::table('order_products')->insert([
            'order_nr' => 'q1EsXOXqUX',
            'product_id' => 6,
            'size_id' => 34,
            'quantity' => 1,
            'created_at' => now(),
        ]);

        DB::table('order_products')->insert([
            'order_nr' => 'q1EsXOXqUX',
            'product_id' => 2,
            'size_id' => 13,
            'quantity' => 1,
            'created_at' => now(),
        ]);

        //---------------------------------------------------------------------------------------------------------------------------------------

        DB::table('order_products')->insert([
            'order_nr' => 'JzMoPJUdUJ',
            'product_id' => 4,
            'size_id' => 24,
            'quantity' => 1,
            'created_at' => now(),
        ]);

        DB::table('order_products')->insert([
            'order_nr' => 'JzMoPJUdUJ',
            'product_id' => 4,
            'size_id' => 25,
            'quantity' => 1,
            'created_at' => now(),
        ]);

        DB::table('order_products')->insert([
            'order_nr' => 'JzMoPJUdUJ',
            'product_id' => 4,
            'size_id' => 26,
            'quantity' => 1,
            'created_at' => now(),
        ]);

        DB::table('order_products')->insert([
            'order_nr' => 'JzMoPJUdUJ',
            'product_id' => 5,
            'size_id' => 29,
            'quantity' => 1,
            'created_at' => now(),
        ]);

        DB::table('order_products')->insert([
            'order_nr' => 'JzMoPJUdUJ',
            'product_id' => 5,
            'size_id' => 30,
            'quantity' => 1,
            'created_at' => now(),
        ]);

        DB::table('order_products')->insert([
            'order_nr' => 'JzMoPJUdUJ',
            'product_id' => 5,
            'size_id' => 31,
            'quantity' => 1,
            'created_at' => now(),
        ]);
    }
}
