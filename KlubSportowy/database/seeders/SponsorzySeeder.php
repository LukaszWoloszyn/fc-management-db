<?php

namespace Database\Seeders;

use App\Models\Sponsorzy;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SponsorzySeeder extends Seeder
{
    public function run(): void
    {
        Sponsorzy::truncate(); // czyścimy tabelę

        Sponsorzy::create([
            'nazwa' => 'Nike',
            'kwota_sponsorowania' => 500000.00,
            'druzyna_id' => 1, // przykładowa drużyna, musisz upewnić się, że istnieje drużyna o id 1
        ]);
    }
}
