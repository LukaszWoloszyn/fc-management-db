<?php

namespace Database\Seeders;

use App\Models\Pracownicy;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PracownicySeeder extends Seeder
{
    public function run(): void
    {
        Pracownicy::truncate(); // czyścimy tabelę

        Pracownicy::create([
            'dane' => 'Jan Kowalski',
            'stanowisko' => 'Trener',
            'druzyna_id' => 1, // przykładowa drużyna, musisz upewnić się, że istnieje drużyna o id 1
        ]);
    }
}
