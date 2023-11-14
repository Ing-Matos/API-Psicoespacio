<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clientes extends Model
{
    use HasFactory;
    
public function cita()
{
    return $this->belongsTo(Citas::class, 'cita_id');
}

    public function medico()
    {
        return $this->belongsTo(Medico::class, 'medico_id');
    }
}
