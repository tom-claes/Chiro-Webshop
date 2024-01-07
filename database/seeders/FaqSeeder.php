<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FaqSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('faqs')->insert([
            'question' => 'Wanneer is kamp?',
            'answer' => 'Kamp begint elk jaar op 21 juli en eindigt op 31 juli.',
            'category' => 3,
            'created_at' => now(),
        ]);

        DB::table('faqs')->insert([
            'question' => 'Hoe geraakt mijn kind op het kamp?',
            'answer' => 'Alle kinderen van groepen: ribbels, speelclub, rakwi & tito moeten worden gebracht met de auto (probeer te carpoolen met de ouders van de vriendjes van uw kind). Alle kinderen van de Keti en Aspi vertrekken 19 of 20 juli met de fiets naar de kampplaats.',
            'category' => 3,
            'created_at' => now(),
        ]);

        DB::table('faqs')->insert([
            'question' => 'Wat is het rekeningnummer van de Chiro?',
            'answer' => 'Het rekeningnummer is: BE19 0882 5882 6812',
            'category' => 2,
            'created_at' => now(),
        ]);
    }
}
