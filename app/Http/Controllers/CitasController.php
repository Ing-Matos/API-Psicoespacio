<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\CitaResource;
use App\Exceptions\SomethingWentWrong;
use App\Models\Citas;
class CitasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $cita = Citas::all();

             return CitaResource::collection($cita);
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
            $cita = new Citas();
            $cita->nombre = $request->nombre;
            $cita->cliente_id = $request->cliente_id;
            $cita->medico_id = $request->medico_id;
            $cita->save();

            $data = [
                "message" => "Cita created successfully",
                "cita" => $cita
            ];
        }catch(\Throwable $th){

            throw new SomethingWentWrong($th);
        }
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
