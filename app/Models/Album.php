<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class Album extends Model
{
    protected $primaryKey = 'AlbumID';
    protected $fillable = ['NamaAlbum', 'Deskripsi', 'TanggalDibuat', 'UserID'];
    public function fotos()
{
    return $this->hasMany(Foto::class, 'AlbumID', 'AlbumID');
}

public function user()
{
    return $this->belongsTo(User::class, 'UserID', 'id');
}
}

