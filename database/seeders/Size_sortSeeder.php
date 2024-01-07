<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class Size_sortSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('size_sorts')->insert([
            'name' => 'Kinderen',
            'type' => 'Broeken',
            'created_at' => now(),
        ]);

        DB::table('size_sorts')->insert([
            'name' => 'Volwassenen',
            'type' => 'Broeken',
            'created_at' => now(),
        ]);

        DB::table('size_sorts')->insert([
            'name' => 'Kinderen',
            'type' => 'T-shirts',
            'created_at' => now(),
        ]);

        DB::table('size_sorts')->insert([
            'name' => 'Volwassenen',
            'type' => 'T-shirts',
            'created_at' => now(),
        ]);

        DB::table('size_sorts')->insert([
            'name' => 'Kinderen',
            'type' => 'Truien',
            'created_at' => now(),
        ]);

        DB::table('size_sorts')->insert([
            'name' => 'Volwassenen',
            'type' => 'Truien',
            'created_at' => now(),
        ]);
    }
}
