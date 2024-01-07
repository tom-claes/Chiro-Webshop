<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Contact_formSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('contact_forms')->insert([
            'lastname' => 'Claes',
            'firstname' => 'Tom',
            'email' => 'claes.tom@gmail.com',
            'subject' => 'Dit is een test',
            'message' => 'Dit is een testbericht',
            'created_at' => now(),
        ]);

        DB::table('contact_forms')->insert([
            'lastname' => 'Rogiers',
            'firstname' => 'Niel',
            'email' => 'rogiers.niel@gmail.com',
            'subject' => 'Vraag',
            'message' => 'Dit is een vraag',
            'created_at' => now(),
        ]);

        DB::table('contact_forms')->insert([
            'lastname' => 'Theeten',
            'firstname' => 'Maxim',
            'email' => 'theeten.maxim@gmail.com',
            'subject' => 'Antwoord',
            'message' => 'Dit is een antwoord',
            'created_at' => now(),
        ]);
    }
}
