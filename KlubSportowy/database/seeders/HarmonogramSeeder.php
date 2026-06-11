<?php

namespace Database\Seeders;

use App\Models\Harmonogram;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HarmonogramSeeder extends Seeder
{
    public function run(): void
    {
        Harmonogram::truncate(); // czyścimy tabelę

        Harmonogram::create([
            'data_spotkania' => '2023-06-15',
            'status_meczu' => 'Planowany',
            'rozgrywki_id' => 1, // przykładowa rozgrywka, musisz upewnić się, że istnieje rozgrywka o id 1
            'druzyna_id' => 1, // przykładowa drużyna, musisz upewnić się, że istnieje drużyna o id 1
        ]);
    }
}
