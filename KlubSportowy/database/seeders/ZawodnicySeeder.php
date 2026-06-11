<?php

namespace Database\Seeders;

use App\Models\Zawodnicy;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ZawodnicySeeder extends Seeder
{
    public function run(): void
    {
        Zawodnicy::truncate(); // czyścimy tabelę

        Zawodnicy::create([
            'dane' => 'Robert Lewandowski',
            'wiek' => 33,
            'pozycja' => 'Napastnik',
            'druzyna_id' => 1, // przykładowa drużyna, musisz upewnić się, że istnieje drużyna o id 1
        ]);
    }
}
