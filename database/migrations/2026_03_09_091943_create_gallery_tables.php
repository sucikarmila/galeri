<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void {
    Schema::table('users', function (Blueprint $table) {
        $table->string('username')->unique()->after('id');
        $table->enum('role', ['admin', 'user'])->default('user')->after('password');
    });

    Schema::create('albums', function (Blueprint $table) {
        $table->id('AlbumID');
        $table->string('NamaAlbum');
        $table->text('Deskripsi');
        $table->date('TanggalDibuat');
        $table->foreignId('UserID')->constrained('users')->onDelete('cascade');
        $table->timestamps();
    });

    Schema::create('fotos', function (Blueprint $table) {
        $table->id('FotoID');
        $table->string('JudulFoto');
        $table->text('DeskripsiFoto');
        $table->date('TanggalUnggah');
        $table->string('LokasiFile');
        $table->foreignId('AlbumID')->constrained('albums', 'AlbumID')->onDelete('cascade');
        $table->foreignId('UserID')->constrained('users')->onDelete('cascade');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gallery_tables');
    }
};
