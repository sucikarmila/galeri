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
        Schema::create('like_fotos', function (Blueprint $table) {
        $table->id('LikeID');
        $table->foreignId('FotoID')->constrained('fotos', 'FotoID')->onDelete('cascade');
        $table->foreignId('UserID')->constrained('users')->onDelete('cascade');
        $table->dateTime('TanggalLike');
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('like_fotos');
    }
};
