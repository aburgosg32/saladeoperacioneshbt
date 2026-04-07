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
        Schema::table('solicituds', function (Blueprint $table) {
            $table->date('fecha_inicio')->nullable()->after('hora_programada');
            $table->time('hora_inicio')->nullable()->after('fecha_inicio');
        });
    }

    public function down(): void
    {
        Schema::table('solicituds', function (Blueprint $table) {
            $table->dropColumn(['fecha_inicio', 'hora_inicio']);
        });
    }
};
