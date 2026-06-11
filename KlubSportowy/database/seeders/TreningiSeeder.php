<?php

namespace Database\Seeders;

use App\Models\Treningi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TreningiSeeder extends Seeder
{
    public function run(): void
    {
        Treningi::truncate(); // czyścimy tabelę

        Treningi::create([
            'data' => '2023-06-15',
            'lokalizacja' => 'Warszawa',
            'druzyna_id' => 1, // przykładowa drużyna, musisz upewnić się, że istnieje drużyna o id 1
        ]);
    }
}
