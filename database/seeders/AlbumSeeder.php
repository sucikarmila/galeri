<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AlbumSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
{
    \App\Models\Album::create([
        'NamaAlbum' => 'Galeri Utama',
        'Deskripsi' => 'Album default untuk semua foto',
        'TanggalDibuat' => now(),
        'UserID' => 1, // Pastikan sudah ada user ID 1 (Admin)
    ]);
}
}
