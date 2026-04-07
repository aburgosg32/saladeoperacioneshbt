<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MedicoController extends Controller
{
    public function buscar(Request $request)
    {
        $term = trim($request->get('q', ''));

        $query = DB::connection('sigh')
            ->table('Medicos as M')
            ->join('Empleados as E', 'E.IdEmpleado', '=', 'M.IdEmpleado')
            ->selectRaw("
                M.IdMedico,
                LTRIM(RTRIM(
                    ISNULL(E.ApellidoPaterno,'') + ' ' +
                    ISNULL(E.ApellidoMaterno,'') + ' ' +
                    ISNULL(E.Nombres,'')
                )) as NombreCompletoMedico
            ");

        if ($term !== '') {
            $query->whereRaw("
                LTRIM(RTRIM(
                    ISNULL(E.ApellidoPaterno,'') + ' ' +
                    ISNULL(E.ApellidoMaterno,'') + ' ' +
                    ISNULL(E.Nombres,'')
                )) LIKE ?
            ", ['%' . $term . '%']);
        }

        $medicos = $query
            ->orderBy('NombreCompletoMedico')
            ->limit(20)
            ->get();

        return response()->json([
            'results' => $medicos->map(function ($m) {
                return [
                    'id' => $m->NombreCompletoMedico, // guardaremos el nombre en tu tabla
                    'text' => $m->NombreCompletoMedico,
                ];
            }),
        ]);
    }
}
