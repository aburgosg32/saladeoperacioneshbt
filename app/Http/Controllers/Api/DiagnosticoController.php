<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DiagnosticoController extends Controller
{
    public function porCie10(Request $request)
    {
        $request->validate([
            'codigo' => ['required', 'string', 'max:20'],
        ]);

        $codigo = strtoupper(trim($request->codigo));

        $dx = DB::connection('sigh')
            ->table('dbo.Diagnosticos')
            ->select([
                'CodigoCIE10',
                'DescripcionMINSA',
            ])
            ->where('CodigoCIE10', $codigo)
            ->first();

        if (!$dx) {
            return response()->json([
                'ok' => false,
                'message' => 'CIE10 no encontrado.'
            ], 404);
        }

        return response()->json([
            'ok' => true,
            'data' => [
                'codigo' => $dx->CodigoCIE10,
                'descripcion' => $dx->DescripcionMINSA,
            ]
        ]);
    }
}