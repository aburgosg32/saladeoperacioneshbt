<?php

namespace App\Http\Controllers;

use App\Exports\CirugiasExport;
use App\Models\Solicitud;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;

class ReporteController extends Controller
{
    public function index(Request $request)
    {
        $query = Solicitud::query();

        if ($request->filled('fecha_inicio')) {
            $query->whereDate('fecha_programada', '>=', $request->fecha_inicio);
        }

        if ($request->filled('fecha_fin')) {
            $query->whereDate('fecha_programada', '<=', $request->fecha_fin);
        }

        if ($request->filled('sala_operacion')) {
            $query->where('sala_operacion', $request->sala_operacion);
        }

        if ($request->filled('estado')) {
            $query->where('estado', $request->estado);
        }

        if ($request->filled('tipo_solicitud')) {
            $query->where('tipo_solicitud', $request->tipo_solicitud);
        }

        $reportes = $query
            ->orderByDesc('fecha_programada')
            ->orderByDesc('hora_programada')
            ->paginate(15)
            ->withQueryString();

        return view('reportes.index', compact('reportes'));
    }

    public function exportarExcel(Request $request)
    {
        return Excel::download(new CirugiasExport($request), 'reporte_cirugias.xlsx');
    }

    public function exportarPdf(Request $request)
    {
        $query = Solicitud::query();

        if ($request->filled('fecha_inicio')) {
            $query->whereDate('fecha_programada', '>=', $request->fecha_inicio);
        }

        if ($request->filled('fecha_fin')) {
            $query->whereDate('fecha_programada', '<=', $request->fecha_fin);
        }

        if ($request->filled('sala_operacion')) {
            $query->where('sala_operacion', $request->sala_operacion);
        }

        if ($request->filled('estado')) {
            $query->where('estado', $request->estado);
        }

        if ($request->filled('tipo_solicitud')) {
            $query->where('tipo_solicitud', $request->tipo_solicitud);
        }

        $cirugias = $query
            ->orderByDesc('fecha_programada')
            ->orderByDesc('hora_programada')
            ->get();

        $pdf = Pdf::loadView('reportes.pdf', compact('cirugias'))
            ->setPaper('a4', 'landscape');

        return $pdf->download('reporte_cirugias.pdf');
    }
}
