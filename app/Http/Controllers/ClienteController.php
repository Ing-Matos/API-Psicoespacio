<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\ClienteResource;
use App\Models\Clientes;
use App\Exceptions\SomethingWentWrong;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
           $clients = Clientes::all();

            return ClienteResource::collection($clients);
        } catch (\Throwable $th) {
            throw new SomethingWentWrong($th);

        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "nombre_completo" => "required",
        ]);

        try{
            $client = new Clientes();
            $client->nombre_completo = $request->nombre_completo;
            $client->edad = $request->edad;
            $client->telefono = $request->telefono;
            $client->estatus = $request->estatus;
            $client->antecedentes_medicos = $request->antecedentes_medicos;
            $client->tipo_cita = $request->tipo_cita;
            $client->historial_previo = $request->historial_previo;
            $client->metodo_pago = $request->metodo_pago;
            $client->motivo_consulta = $request->motivo_consulta;
            $client->save();

            $data = [
                "message" => "Client created successfully",
                "client" => $client
            ];
        }catch(\Throwable $th){

            throw new SomethingWentWrong($th);
        }



        return response()->json($data);
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
