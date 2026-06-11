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
        Schema::create('rozgrywki', function (Blueprint $table) {
            $table->increments('id'); // PRIMARY KEY
            $table->string('nazwa', 100);
            $table->date('data_rozpoczecia');
            $table->date('data_zakonczenia');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rozgrywki');
    }
};
