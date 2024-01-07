<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'lastname' => 'Chiro',
            'firstname' => 'Zuun',
            'username' => 'admin',
            'birthdate' => Carbon::create(1948, 9, 1),
            'bio' => 'Dit is het admin account van de organisatie Chiro Zuun',
            'email' => 'chirozuun@gmail.com',
            'password' => Hash::make('wachtwoord'),
            'admin' => true,
            'created_at' => now(),
            'email_verified_at' => now(),
        ]);

        DB::table('users')->insert([
            'lastname' => 'Claes',
            'firstname' => 'Tom',
            'username' => 'claestom',
            'birthdate' => Carbon::create(2003, 5, 9),
            'bio' => 'Hey, ik ben Tom en ik ben al 3 jaar leiding in de Chiro. Ik ben 20 jaar en ik ben al 14 jaar lid van de Chiro. Momenteel ben ik ribbelleiding!',
            'email' => 'tom.claes@gmail.com',
            'password' => Hash::make('wachtwoord'),
            'admin' => false,
            'created_at' => now(),
            'email_verified_at' => now(),
        ]);

        DB::table('users')->insert([
            'lastname' => 'Rogiers',
            'firstname' => 'Niel',
            'username' => 'nielrogiers',
            'birthdate' => Carbon::create(2000, 3, 31),
            'email' => 'niel.rogiers@gmail.com',
            'password' => Hash::make('wachtwoord'),
            'admin' => false,
            'created_at' => now(),
            'email_verified_at' => now(),
        ]);
    }
}
