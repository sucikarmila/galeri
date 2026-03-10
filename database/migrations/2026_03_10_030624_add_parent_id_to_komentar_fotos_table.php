<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('komentar_fotos', function (Blueprint $table) {
        // Tambahkan kolom parent_id yang boleh kosong (nullable)
        $table->unsignedBigInteger('parent_id')->nullable()->after('UserID');
        
        // Opsional: Hubungkan ke primary key-nya sendiri
        $table->foreign('parent_id')->references('KomentarID')->on('komentar_fotos')->onDelete('cascade');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('komentar_fotos', function (Blueprint $table) {
            //
        });
    }
};
