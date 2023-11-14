<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Citas extends Model
{
    use HasFactory;

    // Citas.php
public function medico()
{
    return $this->belongsTo(Medico::class, 'medico_id');
}

public function clientes()
{
    return $this->belongsTo(Clientes::class, 'cliente_id');
}


}
