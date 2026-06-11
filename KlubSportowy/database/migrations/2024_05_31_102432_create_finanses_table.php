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
        Schema::create('finanse', function (Blueprint $table) {
            $table->increments('id'); // PRIMARY KEY
            $table->decimal('kwota', 10, 2);
            $table->string('opis', 200);
            $table->unsignedInteger('sponsor_id'); // FOREIGN KEY

            $table->foreign('sponsor_id')->references('id')->on('sponsorzy')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('finanse');
    }
};
