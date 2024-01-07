<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NieuwsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('latest_news')->insert([
            'title' => "Varken aan't spit",
            'content' => "Varken Aan't Spit is gezellige avond waar we terugblikken op een geslaagd chirojaar samen met al onze leden, ouders en sympathisanten. Deze avond begint met een gratis aperitief alvorens we aan tafel gaan om te genieten van het varkentje dat al van de ochtend staat te draaien. Na het heerlijke eten komt er een band spelen die een uur hun beste nummers speelt. Meezingen wordt aangeraden! Na de band kunnen jullie genieten van ons freepodium. Op ons freepodium komen onze leden, leiding en sympathisanten hun beste talenten tonen; nieuwe leiding word voorgesteld en ook de nieuwe hoofdleiding geeft belangrijke informatie over het nieuwe chirojaar! Na het freepodium zorgt een DJ voor wat gezellige muziek om jullie uit te nodigen naar de dansvloer.",
            'img' => 'IMG/seeder-images/varken_aant_spit.webp',
            'created_at' => now(),
        ]);

        DB::table('latest_news')->insert([
            'title' => "Azuune Quiz",
            'content' => "Op onze quiz gaan we op zoek naar de slimste ploeg. Aan de hand van meerdere ronden testen we jullie kennis op zowel algemene als obscure onderwerpen. Zoek dus nu al een ploegje van maximaal vijf personen en hou onze facebook pagina in het oog om jouw ploegje zo snel mogelijk in te schrijven! Indien je iets teveel aan het genieten bent van de drankjes die we aanbieden en niet meer zo helder kan nadenken, kan je meedoen met onze zuipbeker waar het team met de meeste consumpties wint. Je kan uiteraard proberen de twee te winnen! Er worden ook door onze aspi's verschillende snacks aangeboden om ervoor te zorgen dat jullie team geen honger heeft.",
            'img' => 'IMG/seeder-images/quiz.webp',
            'created_at' => now(),
        ]);
    }
}
