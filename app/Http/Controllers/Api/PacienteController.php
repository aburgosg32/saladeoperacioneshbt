<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PacienteController extends Controller
{
    public function porHistoria(Request $request)
    {
        // HC es INT: validamos como entero
        $request->validate([
            'n_historia' => ['required', 'integer'],
        ]);

        // Castear a int SIEMPRE
        $hc = (int) $request->n_historia;

        $p = DB::connection('sigh')
            ->table('Pacientes')
            ->select([
                'IdPaciente',
                'ApellidoPaterno',
                'ApellidoMaterno',
                'PrimerNombre',
                'SegundoNombre',
                'TercerNombre',
                'FechaNacimiento',
                'NroDocumento',
                'NroHistoriaClinica',
                'GrupoSanguineo',
                'FactorRh',
            ])
            ->where('NroHistoriaClinica', $hc)
            ->first();

        if (!$p) {
            return response()->json([
                'ok' => false,
                'message' => 'Historia clínica no encontrada.'
            ], 404);
        }

        $nombres = trim(implode(' ', array_filter([
            $p->PrimerNombre ?? null,
            $p->SegundoNombre ?? null,
            $p->TercerNombre ?? null,
        ])));

        $apellidos = trim(implode(' ', array_filter([
            $p->ApellidoPaterno ?? null,
            $p->ApellidoMaterno ?? null,
        ])));

        $nombreCompleto = trim($apellidos . ' ' . $nombres);

        $edad = null;
        if (!empty($p->FechaNacimiento)) {
            $edad = Carbon::parse($p->FechaNacimiento)->age;
        }

        return response()->json([
            'ok' => true,
            'data' => [
                'id_paciente' => $p->IdPaciente,
                'n_historia' => $p->NroHistoriaClinica,
                'paciente' => $nombreCompleto,
                'edad' => $edad,
                'fecha_nacimiento' => $p->FechaNacimiento,
                'nro_documento' => $p->NroDocumento,
                'grupo_sanguineo' => $p->GrupoSanguineo,
                'factor_rh' => $p->FactorRh,
            ]
        ]);
    }
}