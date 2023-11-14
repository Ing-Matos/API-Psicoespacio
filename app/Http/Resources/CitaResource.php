<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CitaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [

            "id"=> $this->id,
            "nombre_cita"=> $this->nombre,
            "nombre_medico" => $this->medico->nombre ?? null ,
            "nombre_paciente"=>$this->clientes->nombre_completo ?? null
        ];
    }
}
