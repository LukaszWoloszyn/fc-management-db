<?php

namespace Database\Seeders;

use App\Models\Rozgrywki;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RozgrywkiSeeder extends Seeder
{
    public function run(): void
    {
        Rozgrywki::truncate(); // czyścimy tabelę

        Rozgrywki::create([
            'nazwa' => 'Premier League',
            'data_rozpoczecia' => '2023-08-10',
            'data_zakonczenia' => '2024-05-20',
        ]);
    }
}
