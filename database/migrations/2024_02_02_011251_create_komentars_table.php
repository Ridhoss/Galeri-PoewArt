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
        Schema::create('komentars', function (Blueprint $table) {
            $table->id();
            $table->foreignId('fotoId')
                ->references('id')->on('fotos')
                ->onDelete('cascade');
            $table->foreignId('userId')
                ->references('id')->on('users')
                ->onDelete('cascade');
            $table->text('isikomentar');
            $table->date('tanggalkomentar');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('komentars');
    }
};
