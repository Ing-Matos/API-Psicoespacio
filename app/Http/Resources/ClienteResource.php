<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ClienteResource extends JsonResource
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
            "nombre_completo"=> $this->nombre_completo,
            "edad"=>$this->edad ?? null,
            "telefono"=>$this->telefono ?? null,
            "tipo_cita"=>$this->tipo_cita ?? null


        ];
    }
}
