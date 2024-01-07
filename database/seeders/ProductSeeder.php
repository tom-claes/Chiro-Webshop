<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('products')->insert([
            'name' => 'Chiro Short',
            'description' => 'De grootste verandering bij onze kinderbermuda is de stof: een zeer stevig maar veel lichter katoen die het draagcomfort bevordert. Ook de pasvorm werd aangepast. Zo zijn de pijpen minder wijd, is de broek hoger in de taille en is er een verstelbaar elastiek zodat ze beter aansluit. De bermuda werd ook iets korter in de kleine maatjes en iets langer in de grootste maten. Alles dus om jullie Chirozondag nog aangenamer te maken!',
            'size_sort' => 1,
            'price' => 36,
            'img' => 'IMG/seeder-images/short-kinderen.jpg',
            'category' => 3,
            'created_at' => now(),
        ]);

        DB::table('products')->insert([
            'name' => 'Chiro Short',
            'description' => 'De grootste verandering bij onze kinderbermuda is de stof: een zeer stevig maar veel lichter katoen die het draagcomfort bevordert. Ook de pasvorm werd aangepast. Zo zijn de pijpen minder wijd, is de broek hoger in de taille en is er een verstelbaar elastiek zodat ze beter aansluit. De bermuda werd ook iets korter in de kleine maatjes en iets langer in de grootste maten. Alles dus om jullie Chirozondag nog aangenamer te maken!',
            'size_sort' => 2,
            'price' => 42,
            'img' => 'IMG/seeder-images/short-volwassenen.jpg',
            'category' => 3,
            'created_at' => now(),
        ]);

        DB::table('products')->insert([
            'name' => 'Gele Zuunman T-shirt',
            'description' => 'Een leuke Chiro Zuun t-shirt met ons logo op de voor en achterkant! Val op met deze kleurijke t-shirt!',
            'size_sort' => 3,
            'price' => 15,
            'img' => 'IMG/seeder-images/T-shirt.webp',
            'category' => 1,
            'created_at' => now(),
        ]);

        DB::table('products')->insert([
            'name' => 'Gele Zuunman T-shirt',
            'description' => 'Een leuke Chiro Zuun t-shirt met ons logo op de voor en achterkant! Val op met deze kleurijke t-shirt!',
            'size_sort' => 4,
            'price' => 15,
            'img' => 'IMG/seeder-images/T-shirt.webp',
            'category' => 1,
            'created_at' => now(),
        ]);

        DB::table('products')->insert([
            'name' => 'Zuunman Trui',
            'description' => 'Een leuke Chiro Zuun hoodie met ons logo op de achterkant! Heb geen moment te koud met deze lekker warme en stijlvolle hoodie!',
            'size_sort' => 5,
            'price' => 25,
            'img' => 'IMG/seeder-images/Trui.webp',
            'category' => 2,
            'created_at' => now(),
        ]);

        DB::table('products')->insert([
            'name' => 'Zuunman Trui',
            'description' => 'Een leuke Chiro Zuun hoodie met ons logo op de achterkant! Heb geen moment te koud met deze lekker warme en stijlvolle hoodie!',
            'size_sort' => 6,
            'price' => 25,
            'img' => 'IMG/seeder-images/Trui.webp',
            'category' => 2,
            'created_at' => now(),
        ]);
    }
}
