<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LikeFoto extends Model
{
    protected $primaryKey = 'LikeID'; 

    protected $fillable = ['FotoID', 'UserID', 'TanggalLike'];

}