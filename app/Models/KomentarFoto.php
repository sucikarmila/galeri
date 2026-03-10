<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany; 

class KomentarFoto extends Model
{
    protected $primaryKey = 'KomentarID';
    
    protected $fillable = ['FotoID', 'UserID', 'IsiKomentar', 'TanggalKomentar', 'parent_id'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'UserID', 'id');
    }

    public function replies()
    {
        return $this->hasMany(KomentarFoto::class, 'parent_id', 'KomentarID');
    }
}