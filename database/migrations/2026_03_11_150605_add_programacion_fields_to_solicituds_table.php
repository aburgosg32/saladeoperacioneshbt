<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('solicituds', function (Blueprint $table) {
            $table->date('fecha_programada')->nullable()->after('a_horas');
            $table->time('hora_programada')->nullable()->after('fecha_programada');
            $table->string('sala_operacion', 50)->nullable()->after('hora_programada');
        });
    }

    public function down(): void
    {
        Schema::table('solicituds', function (Blueprint $table) {
            $table->dropColumn([
                'fecha_programada',
                'hora_programada',
                'sala_operacion',
            ]);
        });
    }
};
