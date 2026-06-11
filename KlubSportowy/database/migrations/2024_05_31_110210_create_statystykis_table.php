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
        Schema::create('statystyki', function (Blueprint $table) {
            $table->increments('id'); // PRIMARY KEY
            $table->integer('bramki')->nullable();
            $table->integer('asysty')->nullable();
            $table->integer('zolte_kartki')->nullable();
            $table->integer('czerwone_kartki')->nullable();
            $table->unsignedInteger('zawodnik_id'); // FOREIGN KEY
            $table->unsignedInteger('mecz_id'); // FOREIGN KEY

            $table->foreign('zawodnik_id')->references('id')->on('zawodnicy')->onDelete('cascade');
            $table->foreign('mecz_id')->references('id')->on('harmonogram')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('statystyki');
    }
};
