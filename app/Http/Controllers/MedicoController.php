<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Medico;
use App\Exceptions\SomethingWentWrong;
use App\Http\Resources\MedicoResource;

class MedicoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $medico = Medico::all();

             return MedicoResource::collection($medico);
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
            "nombre" => "required",
        ]);

        try{
            $medico = new Medico();
            $medico->nombre = $request->nombre;
            $medico->apellido = $request->apellido;
            $medico->save();

            $data = [
                "message" => "medico created successfully",
                "medico" => $medico
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
