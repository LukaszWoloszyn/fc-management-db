<?php

namespace Database\Seeders;

use App\Models\Druzyny;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DruzynySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Druzyny::truncate(); // Usuwamy dane z tabeli
        Druzyny::create([
            'nazwa_druzyny' => 'Real Madryt',
            'kategoria' => 'U21',
        ]);
    }
}
