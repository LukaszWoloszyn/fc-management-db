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
        Schema::create('harmonogram', function (Blueprint $table) {
            $table->increments('id'); // PRIMARY KEY
            $table->date('data_spotkania');
            $table->string('status_meczu', 50);
            $table->unsignedInteger('rozgrywki_id'); // FOREIGN KEY
            $table->unsignedInteger('druzyna_id'); // FOREIGN KEY

            $table->foreign('rozgrywki_id')->references('id')->on('rozgrywki')->onDelete('cascade');
            $table->foreign('druzyna_id')->references('id')->on('druzyny')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('harmonogram');
    }
};
