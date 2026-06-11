<?php

namespace Database\Seeders;

use App\Models\Statystyki;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatystykiSeeder extends Seeder
{
    public function run(): void
    {
        Statystyki::truncate(); // czyścimy tabelę

        Statystyki::create([
            'bramki' => 10,
            'asysty' => 5,
            'zolte_kartki' => 2,
            'czerwone_kartki' => 1,
            'zawodnik_id' => 1, // przykładowy zawodnik, musisz upewnić się, że istnieje zawodnik o id 1
            'mecz_id' => 1, // przykładowy mecz, musisz upewnić się, że istnieje mecz o id 1
        ]);
    }
}
