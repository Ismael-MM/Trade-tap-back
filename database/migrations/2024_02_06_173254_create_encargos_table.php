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
        Schema::create('encargos', function (Blueprint $table) {
            $table->id();
            $table->enum('estado', ["Entregado", "Pendiente", "Cancelado"]);
            $table->date('fecha_entregada_inicio');
            $table->date('fecha_entregada_final');
            $table->foreignId('trabajador_id');
            $table->foreignId('cliente_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('encargos');
    }
};
