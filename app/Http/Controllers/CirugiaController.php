<?php

namespace App\Http\Controllers;

use App\Models\Solicitud;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CirugiaController extends Controller
{
    public function index(Request $request)
    {
        $fechaInicio = $request->fecha_inicio;
        $fechaFin = $request->fecha_fin;

        $query = Solicitud::query();

        if ($fechaInicio && $fechaFin) {
            $query->where(function ($q) use ($fechaInicio, $fechaFin) {
                $q->where(function ($sub) use ($fechaInicio, $fechaFin) {
                    $sub->where('estado', 'S')
                        ->whereDate('para_el_dia', '>=', $fechaInicio)
                        ->whereDate('para_el_dia', '<=', $fechaFin);
                })
                    ->orWhere(function ($sub) use ($fechaInicio, $fechaFin) {
                        $sub->where('estado', '!=', 'S')
                            ->whereDate('fecha_programada', '>=', $fechaInicio)
                            ->whereDate('fecha_programada', '<=', $fechaFin);
                    });
            });
        } elseif ($fechaInicio) {
            $query->where(function ($q) use ($fechaInicio) {
                $q->where(function ($sub) use ($fechaInicio) {
                    $sub->where('estado', 'S')
                        ->whereDate('para_el_dia', '>=', $fechaInicio);
                })
                    ->orWhere(function ($sub) use ($fechaInicio) {
                        $sub->where('estado', '!=', 'S')
                            ->whereDate('fecha_programada', '>=', $fechaInicio);
                    });
            });
        } elseif ($fechaFin) {
            $query->where(function ($q) use ($fechaFin) {
                $q->where(function ($sub) use ($fechaFin) {
                    $sub->where('estado', 'S')
                        ->whereDate('para_el_dia', '<=', $fechaFin);
                })
                    ->orWhere(function ($sub) use ($fechaFin) {
                        $sub->where('estado', '!=', 'S')
                            ->whereDate('fecha_programada', '<=', $fechaFin);
                    });
            });
        }

        $cirugiasHoy = $query
            ->orderByRaw("COALESCE(fecha_programada, para_el_dia) DESC")
            ->orderBy('hora_programada', 'asc')
            ->get();

        $totalHoy = $cirugiasHoy->count();
        $programadas = $cirugiasHoy->where('estado', 'P')->count();
        $enCurso = $cirugiasHoy->where('estado', 'E')->count();
        $culminadas = $cirugiasHoy->where('estado', 'C')->count();
        $solicitadas = $cirugiasHoy->where('estado', 'S')->count();

        $emergencias = $cirugiasHoy
            ->filter(fn($c) => strtoupper($c->tipo_solicitud ?? '') === 'EMERGENCIA')
            ->count();

        $salasOcupadas = $cirugiasHoy
            ->pluck('sala_operacion')
            ->filter()
            ->unique()
            ->count();

        $proximaCirugia = $cirugiasHoy
            ->filter(fn($c) => !empty($c->hora_programada) && in_array($c->estado, ['P', 'E']))
            ->sortBy('hora_programada')
            ->first();

        return view('cirugias.index', compact(
            'cirugiasHoy',
            'totalHoy',
            'programadas',
            'enCurso',
            'culminadas',
            'solicitadas',
            'emergencias',
            'salasOcupadas',
            'proximaCirugia',
            'fechaInicio',
            'fechaFin'
        ));
    }

    public function panelTv()
    {
        $hoy = Carbon::today()->toDateString();

        $cirugiasHoy = Solicitud::where(function ($q) use ($hoy) {
            $q->whereDate('fecha_programada', $hoy)
                ->orWhere(function ($sub) use ($hoy) {
                    $sub->where('estado', 'S')
                        ->whereDate('para_el_dia', $hoy);
                });
        })
            ->orderBy('hora_programada', 'asc')
            ->get();

        $totalHoy = $cirugiasHoy->count();
        $programadas = $cirugiasHoy->where('estado', 'P')->count();
        $enCurso = $cirugiasHoy->where('estado', 'E')->count();
        $culminadas = $cirugiasHoy->where('estado', 'C')->count();
        $solicitadas = $cirugiasHoy->where('estado', 'S')->count();

        $emergencias = $cirugiasHoy
            ->filter(fn($c) => strtoupper($c->tipo_solicitud ?? '') === 'EMERGENCIA')
            ->count();

        $salasOcupadas = $cirugiasHoy
            ->pluck('sala_operacion')
            ->filter()
            ->unique()
            ->count();

        $proximaCirugia = $cirugiasHoy
            ->filter(fn($c) => !empty($c->hora_programada) && $c->estado === 'P')
            ->first();

        return view('cirugias.panel_tv', compact(
            'cirugiasHoy',
            'totalHoy',
            'programadas',
            'enCurso',
            'culminadas',
            'solicitadas',
            'emergencias',
            'salasOcupadas',
            'proximaCirugia'
        ));
    }
}
