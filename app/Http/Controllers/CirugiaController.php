<?php

namespace App\Http\Controllers;

use App\Models\Solicitud;
use Carbon\Carbon;

class CirugiaController extends Controller
{
    public function index()
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
        $emergencias = $cirugiasHoy->where('tipo_solicitud', 'EMERGENCIA')->count();
        $salasOcupadas = $cirugiasHoy->pluck('sala_operacion')->filter()->unique()->count();

        $proximaCirugia = $cirugiasHoy
            ->filter(fn($c) => !empty($c->hora_programada) && $c->estado === 'P')
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
            'proximaCirugia'
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
        $emergencias = $cirugiasHoy->where('tipo_solicitud', 'EMERGENCIA')->count();
        $salasOcupadas = $cirugiasHoy->pluck('sala_operacion')->filter()->unique()->count();

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
