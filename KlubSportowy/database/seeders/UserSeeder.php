<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class USerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::withoutForeignKeyConstraints(function () {
            User::truncate();
        });

        User::insert(
            [
                [
                    'name' => 'admin', 'surname' => 'admin', 'email' => 'admin@wp.pl', 'password' => Hash::make('aaa'), 'administrator' => '1'
                ],
            ]
        );
    }
}
