<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class testimonials extends Model
{
    use HasFactory;

    protected $fillable = [
        
        'title',
        'body',
        'user_name',
        'user_id',
        'user_photo'

    ];

}
