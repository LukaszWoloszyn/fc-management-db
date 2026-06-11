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
        Schema::create('pracownicy', function (Blueprint $table) {
            $table->increments('id'); // PRIMARY KEY
            $table->string('dane', 100);
            $table->string('stanowisko', 100);
            $table->unsignedInteger('druzyna_id'); // FOREIGN KEY

            $table->foreign('druzyna_id')->references('id')->on('druzyny')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pracownicy');
    }
};
