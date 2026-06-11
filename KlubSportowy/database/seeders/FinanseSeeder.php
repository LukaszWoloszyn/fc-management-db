<?php

namespace Database\Seeders;

use App\Models\Finanse;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FinanseSeeder extends Seeder
{
    public function run(): void
    {
        Finanse::truncate(); // czyścimy tabelę

        Finanse::create([
            'kwota' => 10000.00,
            'opis' => 'Wsparcie finansowe na sezon 2024',
            'sponsor_id' => 1, // przykładowy sponsor, musisz upewnić się, że istnieje sponsor o id 1
        ]);
    }
}
