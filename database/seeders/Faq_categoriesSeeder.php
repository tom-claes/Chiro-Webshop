<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Faq_categoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('faq_categories')->insert([
            'name' => 'Evenementen',
            'created_at' => now(),
        ]);

        DB::table('faq_categories')->insert([
            'name' => 'Betalingen',
            'created_at' => now(),
        ]);
 
        DB::table('faq_categories')->insert([
            'name' => 'Kamp',
            'pin' => now(),
            'created_at' => now(),
        ]);
    }
}
