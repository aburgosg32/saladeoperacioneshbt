<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('solicituds', function (Blueprint $table) {
            $table->string('codigo_diagnostico', 20)->nullable()->after('cama');
        });
    }

    public function down(): void
    {
        Schema::table('solicituds', function (Blueprint $table) {
            $table->dropColumn('codigo_diagnostico');
        });
    }
};