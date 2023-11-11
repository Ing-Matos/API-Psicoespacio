<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->id();
            $table->string("nombre_completo");
            $table->string("edad");
            $table->string("telefono");
            $table->string("estatus");
            $table->string("antecedentes_medicos");
            $table->string("tipo_cita");
            $table->string("historial_previo");
            $table->string("metodo_pago");
            $table->string("motivo_consulta");
            $table->unsignedBigInteger('medico_id')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clientes');
    }
};
