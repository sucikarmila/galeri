<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class Album extends Model
{
    protected $primaryKey = 'AlbumID';
    protected $fillable = ['NamaAlbum', 'Deskripsi', 'TanggalDibuat', 'UserID'];
}

