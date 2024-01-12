<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('orders')->insert([
            'order_nr' => 'Xe6ZOaItRp',
            'total_price' => 106,
            'lastname' => 'Claes',
            'firstname' => 'Tom',
            'email' => 'claes.tom@gmail.com',
            'phone' => '0412345678',
            'street' => 'Ridderstraat',
            'streetnr' => 263,
            'zip' => 3000,
            'city' => 'Leuven',
            'created_at' => now(),
        ]);

        DB::table('orders')->insert([
            'order_nr' => '5NsJRh81bW',
            'total_price' => 25,
            'lastname' => 'Rogiers',
            'firstname' => 'Niel',
            'email' => 'rogiers.niel@gmail.com',
            'phone' => '0413524678',
            'street' => 'Kerkstraat',
            'streetnr' => 1,
            'zip' => 1600,
            'city' => 'Sint-Pieters-Leeuw',
            'created_at' => now(),
        ]);

        DB::table('orders')->insert([
            'order_nr' => 'q1EsXOXqUX',
            'total_price' => 67,
            'lastname' => 'Heyns',
            'firstname' => 'Ignas',
            'email' => 'heyns.ignas@gmail.com',
            'phone' => '0487654321',
            'street' => 'Ketchuplaan',
            'streetnr' => 13,
            'zip' => 1500,
            'city' => 'Halle',
            'created_at' => now(),
        ]);

        DB::table('orders')->insert([
            'order_nr' => 'JzMoPJUdUJ',
            'total_price' => 120,
            'lastname' => 'Van den Wijngaert',
            'firstname' => 'Tim',
            'email' => 'vdw.tim@gmail.com',
            'phone' => '0467812345',
            'street' => 'Sonjastraat',
            'streetnr' => 15,
            'zip' => 1600,
            'city' => 'Sint-Pieters-Leeuw',
            'created_at' => now(),
        ]);

        
    }
}
