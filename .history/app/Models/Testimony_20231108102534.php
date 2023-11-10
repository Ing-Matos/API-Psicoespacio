<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class testimony extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'body',
        'id_user',
        'user_name',
        'photo_user'
    ];
}
