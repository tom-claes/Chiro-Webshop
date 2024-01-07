<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SizeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        //Maten: https://www.debanier.be/bermuda-kinderen.html

        DB::table('sizes')->insert([
            'size_sort' => 1,
            'size' => '6/116',
            'created_at' => now(),
        ]);

        DB::table('sizes')->insert([
            'size_sort' => 1,
            'size' => '8/128',
            'created_at' => now(),
        ]);

        DB::table('sizes')->insert([
            'size_sort' => 1,
            'size' => '10/140',
            'created_at' => now(),
        ]);

        DB::table('sizes')->insert([
            'size_sort' => 1,
            'size' => '12/152',
            'created_at' => now(),
        ]);

        DB::table('sizes')->insert([
            'size_sort' => 1,
            'size' => '14/164',
            'created_at' => now(),
        ]);

        DB::table('sizes')->insert([
            'size_sort' => 1,
            'size' => '16/176',
            'created_at' => now(),
        ]);


        //----------------------------------------------------------------------------------------------------------------------------------

        //Maten: https://www.debanier.be/short-volwassene-jeansmaten.html


        DB::table('sizes')->insert([
            'size_sort' => 2,
            'size' => '29',
            'created_at' => now(),
        ]);

        DB::table('sizes')->insert([
            'size_sort' => 2,
            'size' => '30',
            'created_at' => now(),
        ]);

        DB::table('sizes')->insert([
            'size_sort' => 2,
            'size' => '31',
            'created_at' => now(),
        ]);

        DB::table('sizes')->insert([
            'size_sort' => 2,
            'size' => '32',
            'created_at' => now(),
        ]);

        DB::table('sizes')->insert([
            'size_sort' => 2,
            'size' => '33',
            'created_at' => now(),
        ]);

        DB::table('sizes')->insert([
            'size_sort' => 2,
            'size' => '34',
            'created_at' => now(),
        ]);

        DB::table('sizes')->insert([
            'size_sort' => 2,
            'size' => '36',
            'created_at' => now(),
        ]);

        DB::table('sizes')->insert([
            'size_sort' => 2,
            'size' => '38',
            'created_at' => now(),
        ]);

        DB::table('sizes')->insert([
            'size_sort' => 2,
            'size' => '40',
            'created_at' => now(),
        ]);

        DB::table('sizes')->insert([
            'size_sort' => 2,
            'size' => '42',
            'created_at' => now(),
        ]);

        //----------------------------------------------------------------------------------------------------------------------------------

        DB::table('sizes')->insert([
            'size_sort' => 3,
            'size' => 'XS',
            'created_at' => now(),
        ]);

        DB::table('sizes')->insert([
            'size_sort' => 3,
            'size' => 'S',
            'created_at' => now(),
        ]);

        DB::table('sizes')->insert([
            'size_sort' => 3,
            'size' => 'M',
            'created_at' => now(),
        ]);

        DB::table('sizes')->insert([
            'size_sort' => 3,
            'size' => 'L',
            'created_at' => now(),
        ]);

        DB::table('sizes')->insert([
            'size_sort' => 3,
            'size' => 'XL',
            'created_at' => now(),
        ]);

        //----------------------------------------------------------------------------------------------------------------------------------

        DB::table('sizes')->insert([
            'size_sort' => 4,
            'size' => 'XS',
            'created_at' => now(),
        ]);

        DB::table('sizes')->insert([
            'size_sort' => 4,
            'size' => 'S',
            'created_at' => now(),
        ]);

        DB::table('sizes')->insert([
            'size_sort' => 4,
            'size' => 'M',
            'created_at' => now(),
        ]);

        DB::table('sizes')->insert([
            'size_sort' => 4,
            'size' => 'L',
            'created_at' => now(),
        ]);

        DB::table('sizes')->insert([
            'size_sort' => 4,
            'size' => 'XL',
            'created_at' => now(),
        ]);

        //----------------------------------------------------------------------------------------------------------------------------------

        DB::table('sizes')->insert([
            'size_sort' => 5,
            'size' => 'XS',
            'created_at' => now(),
        ]);

        DB::table('sizes')->insert([
            'size_sort' => 5,
            'size' => 'S',
            'created_at' => now(),
        ]);

        DB::table('sizes')->insert([
            'size_sort' => 5,
            'size' => 'M',
            'created_at' => now(),
        ]);

        DB::table('sizes')->insert([
            'size_sort' => 5,
            'size' => 'L',
            'created_at' => now(),
        ]);

        DB::table('sizes')->insert([
            'size_sort' => 5,
            'size' => 'XL',
            'created_at' => now(),
        ]);

        //----------------------------------------------------------------------------------------------------------------------------------

        DB::table('sizes')->insert([
            'size_sort' => 6,
            'size' => 'XS',
            'created_at' => now(),
        ]);

        DB::table('sizes')->insert([
            'size_sort' => 6,
            'size' => 'S',
            'created_at' => now(),
        ]);

        DB::table('sizes')->insert([
            'size_sort' => 6,
            'size' => 'M',
            'created_at' => now(),
        ]);

        DB::table('sizes')->insert([
            'size_sort' => 6,
            'size' => 'L',
            'created_at' => now(),
        ]);

        DB::table('sizes')->insert([
            'size_sort' => 6,
            'size' => 'XL',
            'created_at' => now(),
        ]);
    }
}
