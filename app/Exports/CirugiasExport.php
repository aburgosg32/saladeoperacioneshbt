<?php

namespace App\Exports;

use App\Models\Solicitud;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class CirugiasExport implements FromView
{
    protected $request;

    public function __construct($request)
    {
        $this->request = $request;
    }

    public function view(): View
    {
        $query = Solicitud::query();

        if ($this->request->filled('fecha_inicio')) {
            $query->whereDate('fecha_programada', '>=', $this->request->fecha_inicio);
        }

        if ($this->request->filled('fecha_fin')) {
            $query->whereDate('fecha_programada', '<=', $this->request->fecha_fin);
        }

        if ($this->request->filled('sala_operacion')) {
            $query->where('sala_operacion', $this->request->sala_operacion);
        }

        if ($this->request->filled('estado')) {
            $query->where('estado', $this->request->estado);
        }

        if ($this->request->filled('tipo_solicitud')) {
            $query->where('tipo_solicitud', $this->request->tipo_solicitud);
        }

        $cirugias = $query
            ->orderByDesc('fecha_programada')
            ->orderByDesc('hora_programada')
            ->get();

        return view('reportes.excel', compact('cirugias'));
    }
}
