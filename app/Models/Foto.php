<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Foto extends Model
{
    protected $primaryKey = 'FotoID'; 
    protected $fillable = ['JudulFoto', 'DeskripsiFoto', 'TanggalUnggah', 'LokasiFile', 'AlbumID', 'UserID'];

    
    public function likes(): HasMany
    {
        return $this->hasMany(LikeFoto::class, 'FotoID', 'FotoID');
    }

   
    public function komentars(): HasMany
    {
        return $this->hasMany(KomentarFoto::class, 'FotoID', 'FotoID');
    }

    
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'UserID', 'id');
    }
    public function album()
{
    return $this->belongsTo(Album::class, 'AlbumID', 'AlbumID');
}
}