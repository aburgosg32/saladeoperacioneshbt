<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OperacionController extends Controller
{
    public function porCpt(Request $request)
    {
        $request->validate([
            'codigo' => ['required', 'string', 'max:20'],
        ]);

        $codigo = trim($request->codigo);

        $op = DB::connection('sigh')
            ->table('dbo.FactCatalogoServicios')
            ->select([
                'codigoSIS',
                'Nombre',
            ])
            ->where('codigoSIS', $codigo)
            ->first();

        if (!$op) {
            return response()->json([
                'ok' => false,
                'message' => 'CPT no encontrado.'
            ], 404);
        }

        return response()->json([
            'ok' => true,
            'data' => [
                'codigo' => $op->codigoSIS,
                'descripcion' => $op->Nombre,
            ]
        ]);
    }
}