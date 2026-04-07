<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('solicituds', function (Blueprint $table) {
            $table->date('fecha_culminacion')->nullable()->after('sala_operacion');
            $table->time('hora_culminacion')->nullable()->after('fecha_culminacion');
            $table->text('observacion_culminacion')->nullable()->after('hora_culminacion');
        });
    }

    public function down(): void
    {
        Schema::table('solicituds', function (Blueprint $table) {
            $table->dropColumn([
                'fecha_culminacion',
                'hora_culminacion',
                'observacion_culminacion',
            ]);
        });
    }
};
