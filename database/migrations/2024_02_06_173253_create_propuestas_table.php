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
        Schema::create('propuestas', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->text('descripcion');
            $table->decimal('presupuesto')->nullable()->default(0);
            $table->date('fecha_estimada_inicio');
            $table->date('fecha_estimada_final');
            $table->enum('tipo', ["Encargo", "Reserva"]);
            $table->enum('estado', ["Aceptado", "Pendiente", "Rechazado"])->nullable()->default('Pendiente');
            $table->foreignId('cliente_id');
            $table->foreignId('trabajador_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('propuestas');
    }
};
