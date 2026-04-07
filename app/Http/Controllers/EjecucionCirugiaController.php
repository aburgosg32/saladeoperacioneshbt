<?php

namespace App\Http\Controllers;

use App\Models\Solicitud;
use Illuminate\Http\Request;
use Carbon\Carbon;

class EjecucionCirugiaController extends Controller
{
    public function index(Request $request)
    {
        $fecha = $request->fecha ?? now()->format('Y-m-d');

        $cirugias = Solicitud::whereDate('fecha_programada', $fecha)
            ->whereIn('estado', ['P', 'E'])
            ->orderBy('hora_programada')
            ->orderBy('id')
            ->paginate(12)
            ->withQueryString();

        $totalProgramadas = Solicitud::whereDate('fecha_programada', $fecha)
            ->where('estado', 'P')
            ->count();

        $totalEnCurso = Solicitud::whereDate('fecha_programada', $fecha)
            ->where('estado', 'E')
            ->count();

        $totalCulminadas = Solicitud::whereDate('fecha_programada', $fecha)
            ->where('estado', 'C')
            ->count();

        return view('ejecucion_cirugias.index', compact(
            'cirugias',
            'fecha',
            'totalProgramadas',
            'totalEnCurso',
            'totalCulminadas'
        ));
    }

    public function iniciar($id)
    {
        $cirugia = \App\Models\Solicitud::findOrFail($id);

        if ($cirugia->estado !== 'P') {
            return redirect()
                ->route('ejecucion-cirugias.index', ['fecha' => $cirugia->fecha_programada])
                ->with('error', 'Solo se puede iniciar una operación programada.');
        }

        if (empty($cirugia->sala_operacion)) {
            return redirect()
                ->route('ejecucion-cirugias.index', ['fecha' => $cirugia->fecha_programada])
                ->with('error', 'No se puede iniciar la operación porque no tiene sala asignada.');
        }

        $salaOcupada = \App\Models\Solicitud::whereDate('fecha_programada', $cirugia->fecha_programada)
            ->where('sala_operacion', $cirugia->sala_operacion)
            ->where('estado', 'E')
            ->where('id', '!=', $cirugia->id)
            ->exists();

        if ($salaOcupada) {
            return redirect()
                ->route('ejecucion-cirugias.index', ['fecha' => $cirugia->fecha_programada])
                ->with('error', 'No se puede iniciar la operación porque la ' . $cirugia->sala_operacion . ' ya está ocupada por otra cirugía en curso.');
        }

        $cirugia->update([
            'estado' => 'E',
            'fecha_inicio' => now()->format('Y-m-d'),
            'hora_inicio' => now()->format('H:i:s'),
        ]);

        return redirect()
            ->route('ejecucion-cirugias.index', ['fecha' => $cirugia->fecha_programada])
            ->with('ok', 'Operación iniciada correctamente.');
    }

    public function culminar($id)
    {
        $cirugia = Solicitud::findOrFail($id);

        if ($cirugia->estado !== 'E') {
            return redirect()
                ->route('ejecucion-cirugias.index')
                ->with('error', 'Solo se puede culminar una operación en curso.');
        }

        $fechaFin = now()->format('Y-m-d');
        $horaFin = now()->format('H:i:s');

        $duracion = null;

        if ($cirugia->fecha_inicio && $cirugia->hora_inicio) {
            $inicio = Carbon::parse($cirugia->fecha_inicio . ' ' . $cirugia->hora_inicio);
            $fin = Carbon::parse($fechaFin . ' ' . $horaFin);

            $duracion = $inicio->diff($fin)->format('%H:%I');
        }

        $cirugia->update([
            'estado' => 'C',
            'fecha_culminacion' => $fechaFin,
            'hora_culminacion' => $horaFin,
            'tiempo_real' => $duracion, // opcional si tienes campo
        ]);

        return redirect()
            ->route('ejecucion-cirugias.index', ['fecha' => $cirugia->fecha_programada])
            ->with('ok', 'Operación culminada correctamente.');
    }
}
