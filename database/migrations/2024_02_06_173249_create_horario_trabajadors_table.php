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
        Schema::create('horario_trabajadors', function (Blueprint $table) {
            $table->id();
            $table->enum('rango', ["Lunes-Viernes","Lunes-Sabado","Lunes-Domingo"]);
            $table->timestamp('hora_comienzo');
            $table->timestamp('hora_final');
            $table->foreignId('trabajador_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('horario_trabajadors');
    }
};
