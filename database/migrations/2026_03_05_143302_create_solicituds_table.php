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
         Schema::create('solicituds', function (Blueprint $table) {
        $table->id();

        // Tipo: Programada / Emergencia
        $table->enum('tipo_solicitud', ['PROGRAMADA', 'EMERGENCIA'])->default('PROGRAMADA');

        // Intervención: 1ra/2da/3ra
        $table->enum('intervencion', ['1ra', '2da', '3ra'])->nullable();

        $table->date('dia')->nullable();
        $table->time('hora')->nullable();

        $table->string('servicio')->nullable();

        // HC y datos traídos del SIGH (snapshot)
        $table->string('n_historia')->nullable();
        $table->unsignedBigInteger('id_paciente_sigh')->nullable();
        $table->string('paciente')->nullable();
        $table->unsignedTinyInteger('edad')->nullable();

        $table->string('cama')->nullable();

        $table->text('diagnostico')->nullable();
        $table->text('operacion')->nullable();
        $table->string('codigo_operacion')->nullable();

        $table->decimal('hto', 5, 2)->nullable();
        $table->decimal('hb', 5, 2)->nullable();

        $table->string('gs', 5)->nullable();
        $table->string('rh', 5)->nullable();

        $table->string('cirujano_principal')->nullable();
        $table->string('primer_ayudante')->nullable();
        $table->string('segundo_ayudante')->nullable();
        $table->string('tercer_ayudante')->nullable();
        $table->string('instrumentista')->nullable();

        $table->string('tiempo_operativo_aprox')->nullable();
        $table->string('posicion_paciente')->nullable();

        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('solicituds');
    }
};
