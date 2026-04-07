<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('solicituds', function (Blueprint $table) {
            $table->char('estado', 1)->default('S')->after('intervencion');
        });
    }

    public function down(): void
    {
        Schema::table('solicituds', function (Blueprint $table) {
            $table->dropColumn('estado');
        });
    }
};
