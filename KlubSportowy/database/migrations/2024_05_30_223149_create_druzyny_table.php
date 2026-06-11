<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('druzyny', function (Blueprint $table) {
            $table->increments('id'); // Używamy standardowej nazwy kolumny
            $table->string('nazwa_druzyny'); // Usuwamy nietypowe znaki
            $table->string('kategoria');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('druzyny');
    }
};
