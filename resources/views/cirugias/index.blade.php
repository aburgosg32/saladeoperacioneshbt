@extends('layouts.app')

@section('content')
<style>
    :root {
        --bg0: #061218;
        --bg1: #0a1d28;
        --line: rgba(255, 255, 255, .12);
        --text: #eaf3f8;
        --muted: rgba(234, 243, 248, .72);
        --primary: #2bd4c5;
        --primary2: #1bb3f2;
        --warning: #ffd36b;
        --success: #2bd4c5;
        --danger: #ff6b6b;
        --violet: #9b7bff;
        --shadow: 0 18px 60px rgba(0, 0, 0, .45);
        --radius: 18px;
    }

    .cx-page {
        min-height: calc(100vh - 80px);
        padding: 24px 0 36px;
        background:
            radial-gradient(1100px 650px at 12% 10%, rgba(43, 212, 197, .10), transparent 60%),
            radial-gradient(900px 520px at 90% 15%, rgba(27, 179, 242, .10), transparent 55%),
            linear-gradient(180deg, var(--bg0), var(--bg1));
        color: var(--text);
    }

    .cx-container {
        width: min(1380px, 96vw);
        margin: 0 auto;
    }

    .cx-head {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        gap: 12px;
        flex-wrap: wrap;
        margin-bottom: 18px;
    }

    .cx-title {
        margin: 0;
        font-size: 30px;
        font-weight: 900;
        letter-spacing: .2px;
    }

    .cx-sub {
        margin: 6px 0 0;
        color: var(--muted);
        font-size: 13px;
    }

    .cx-top-actions {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
    }

    .cx-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 10px 14px;
        border-radius: 14px;
        border: 1px solid var(--line);
        background: rgba(12, 40, 56, .35);
        color: var(--text);
        text-decoration: none;
        font-size: 12.5px;
        font-weight: 800;
        transition: .2s ease;
        cursor: pointer;
    }

    .cx-btn:hover {
        border-color: rgba(27, 179, 242, .45);
        background: rgba(12, 40, 56, .55);
        color: var(--text);
        text-decoration: none;
        transform: translateY(-1px);
    }

    .cx-btn-primary {
        background: linear-gradient(135deg, rgba(43, 212, 197, .20), rgba(27, 179, 242, .20));
        border-color: rgba(43, 212, 197, .28);
    }

    .cx-filter {
        margin-bottom: 18px;
        border: 1px solid var(--line);
        border-radius: 18px;
        background:
            radial-gradient(700px 240px at 18% 20%, rgba(43, 212, 197, .08), transparent 55%),
            linear-gradient(180deg, rgba(12, 40, 56, .66), rgba(12, 40, 56, .34));
        box-shadow: var(--shadow);
        padding: 14px 16px;
    }

    .cx-filter-form {
        display: flex;
        align-items: end;
        gap: 12px;
        flex-wrap: wrap;
    }

    .cx-filter-group {
        display: grid;
        gap: 6px;
    }

    .cx-filter-group label {
        color: var(--muted);
        font-size: 11.5px;
        font-weight: 900;
        text-transform: uppercase;
        letter-spacing: .5px;
        margin: 0;
    }

    .cx-input {
        min-width: 170px;
        padding: 10px 12px;
        border-radius: 13px;
        border: 1px solid var(--line);
        background: rgba(6, 18, 24, .50);
        color: var(--text);
        outline: none;
        font-size: 13px;
        font-weight: 700;
    }

    .cx-input:focus {
        border-color: rgba(43, 212, 197, .45);
        box-shadow: 0 0 0 3px rgba(43, 212, 197, .10);
    }

    .cx-grid-kpi {
        display: grid;
        grid-template-columns: repeat(7, 1fr);
        gap: 14px;
        margin-bottom: 18px;
    }

    @media (max-width: 1200px) {
        .cx-grid-kpi {
            grid-template-columns: repeat(3, 1fr);
        }
    }

    @media (max-width: 760px) {
        .cx-grid-kpi {
            grid-template-columns: 1fr;
        }
    }

    .cx-card {
        border: 1px solid var(--line);
        border-radius: 18px;
        background:
            radial-gradient(700px 240px at 18% 20%, rgba(43, 212, 197, .10), transparent 55%),
            linear-gradient(180deg, rgba(12, 40, 56, .78), rgba(12, 40, 56, .40));
        box-shadow: var(--shadow);
        padding: 16px;
        position: relative;
        overflow: hidden;
    }

    .cx-card::after {
        content: "";
        position: absolute;
        right: -20px;
        top: -20px;
        width: 90px;
        height: 90px;
        border-radius: 50%;
        background: radial-gradient(circle, rgba(255, 255, 255, .08), transparent 65%);
        pointer-events: none;
    }

    .cx-card-label {
        color: var(--muted);
        font-size: 11.5px;
        font-weight: 800;
        margin-bottom: 8px;
        text-transform: uppercase;
        letter-spacing: .6px;
    }

    .cx-card-value {
        font-size: 30px;
        font-weight: 900;
        line-height: 1;
    }

    .cx-card-note {
        margin-top: 8px;
        font-size: 12px;
        color: var(--muted);
    }

    .cx-card-mini {
        margin-top: 10px;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 5px 9px;
        border-radius: 999px;
        font-size: 11px;
        font-weight: 800;
        border: 1px solid rgba(255, 255, 255, .10);
        background: rgba(255, 255, 255, .04);
    }

    .cx-row {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 16px;
        margin-bottom: 18px;
    }

    @media (max-width: 1100px) {
        .cx-row {
            grid-template-columns: 1fr;
        }
    }

    .cx-row-2 {
        display: grid;
        grid-template-columns: 1.3fr 1fr 1fr;
        gap: 16px;
        margin-bottom: 18px;
    }

    @media (max-width: 1200px) {
        .cx-row-2 {
            grid-template-columns: 1fr;
        }
    }

    .cx-panel {
        border: 1px solid var(--line);
        border-radius: 18px;
        background:
            radial-gradient(900px 420px at 18% 20%, rgba(43, 212, 197, .10), transparent 55%),
            radial-gradient(700px 420px at 85% 30%, rgba(27, 179, 242, .08), transparent 55%),
            linear-gradient(180deg, rgba(12, 40, 56, .78), rgba(12, 40, 56, .40));
        box-shadow: var(--shadow);
        overflow: hidden;
    }

    .cx-panel-head {
        padding: 14px 16px;
        border-bottom: 1px solid var(--line);
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 12px;
        flex-wrap: wrap;
    }

    .cx-panel-title {
        font-weight: 900;
        font-size: 14px;
        letter-spacing: .3px;
    }

    .cx-count {
        color: var(--muted);
        font-size: 12px;
        border: 1px solid var(--line);
        padding: 6px 10px;
        border-radius: 999px;
        background: rgba(12, 40, 56, .30);
    }

    .cx-panel-body {
        padding: 16px;
    }

    .cx-chart-box {
        height: 310px;
        position: relative;
    }

    .cx-chart-box canvas {
        width: 100% !important;
        height: 100% !important;
        display: block;
    }

    .cx-table-wrap {
        padding: 0 8px 12px;
        overflow-x: auto;
    }

    .cx-table {
        width: 100%;
        border-collapse: collapse;
        min-width: 1160px;
    }

    .cx-table th,
    .cx-table td {
        padding: 12px 10px;
        border-bottom: 1px solid rgba(255, 255, 255, .08);
        font-size: 12.5px;
        vertical-align: middle;
    }

    .cx-table th {
        color: rgba(234, 243, 248, .85);
        font-weight: 900;
        font-size: 12px;
        text-transform: uppercase;
        letter-spacing: .45px;
        background: rgba(12, 40, 56, .22);
    }

    .cx-table tr:hover td {
        background: rgba(255, 255, 255, .025);
    }

    .cx-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 5px 8px;
        border-radius: 999px;
        border: 1px solid var(--line);
        background: rgba(12, 40, 56, .25);
        font-size: 11px;
        font-weight: 800;
        letter-spacing: .2px;
        white-space: nowrap;
    }

    .cx-dot {
        width: 8px;
        height: 8px;
        border-radius: 999px;
        background: var(--primary);
    }

    .cx-dot.red {
        background: var(--danger);
    }

    .cx-dot.blue {
        background: var(--primary2);
    }

    .cx-dot.yellow {
        background: var(--warning);
    }

    .cx-dot.violet {
        background: var(--violet);
    }

    .cx-state {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 5px 10px;
        border-radius: 999px;
        font-size: 11px;
        font-weight: 800;
        border: 1px solid rgba(255, 255, 255, .12);
        white-space: nowrap;
    }

    .cx-state-p {
        background: rgba(43, 212, 197, .12);
        color: #2bd4c5;
        border-color: rgba(43, 212, 197, .28);
    }

    .cx-state-e {
        background: rgba(155, 123, 255, .12);
        color: #c7b5ff;
        border-color: rgba(155, 123, 255, .30);
    }

    .cx-state-c {
        background: rgba(27, 179, 242, .12);
        color: #7fd8ff;
        border-color: rgba(27, 179, 242, .28);
    }

    .cx-state-s {
        background: rgba(255, 193, 7, .12);
        color: #ffd36b;
        border-color: rgba(255, 193, 7, .28);
    }

    .cx-list {
        display: grid;
        gap: 12px;
    }

    .cx-item {
        border: 1px solid rgba(255, 255, 255, .08);
        border-radius: 14px;
        padding: 12px;
        background: rgba(255, 255, 255, .03);
    }

    .cx-item-top {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 8px;
        margin-bottom: 6px;
    }

    .cx-item-title {
        font-size: 13px;
        font-weight: 900;
        color: var(--text);
    }

    .cx-item-sub {
        font-size: 12px;
        color: var(--muted);
    }

    .cx-empty {
        padding: 22px 12px;
        text-align: center;
        color: var(--muted);
        font-size: 13px;
    }

    .cx-progress {
        width: 100%;
        height: 9px;
        border-radius: 999px;
        background: rgba(255, 255, 255, .08);
        overflow: hidden;
        margin-top: 8px;
    }

    .cx-progress-bar {
        height: 100%;
        border-radius: 999px;
        background: linear-gradient(90deg, var(--primary), var(--primary2));
    }

    .cx-split {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 12px;
    }

    @media (max-width: 760px) {
        .cx-split {
            grid-template-columns: 1fr;
        }
    }

    .cx-stat-line {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 10px;
        margin-bottom: 10px;
    }

    .cx-muted {
        color: var(--muted);
    }

    .cx-strong {
        font-weight: 900;
    }
</style>

@php
$solicitadas = (int) $solicitadas;

$textoFiltro = 'Todos los registros';
if (!empty($fechaInicio) && !empty($fechaFin)) {
$textoFiltro = 'Del ' . \Carbon\Carbon::parse($fechaInicio)->format('d/m/Y') . ' al ' . \Carbon\Carbon::parse($fechaFin)->format('d/m/Y');
} elseif (!empty($fechaInicio)) {
$textoFiltro = 'Desde ' . \Carbon\Carbon::parse($fechaInicio)->format('d/m/Y');
} elseif (!empty($fechaFin)) {
$textoFiltro = 'Hasta ' . \Carbon\Carbon::parse($fechaFin)->format('d/m/Y');
}

$fechaMostrar = function ($c) {
$fecha = $c->estado === 'S' ? $c->para_el_dia : $c->fecha_programada;
return $fecha ? \Carbon\Carbon::parse($fecha)->format('d/m/Y') : '-';
};

$cirugiasOrdenadas = collect($cirugiasHoy)
->sortBy(function ($c) {
return ($c->estado === 'S' ? $c->para_el_dia : $c->fecha_programada) . ' ' . ($c->hora_programada ?? '99:99:99');
})
->values();

$proximas = $cirugiasOrdenadas
->filter(fn($c) => in_array($c->estado, ['P', 'E', 'S']))
->take(5);

$cirugiasEmergencia = collect($cirugiasHoy)->filter(function ($c) {
return strtoupper($c->tipo_solicitud ?? '') === 'EMERGENCIA';
})->values();

$porSala = collect($cirugiasHoy)
->groupBy(function ($c) {
return $c->sala_operacion ?: 'Sin sala';
})
->map->count()
->sortDesc();

$ocupacionPct = $totalHoy > 0 ? round((($enCurso + $culminadas) / $totalHoy) * 100) : 0;

$chartSalaLabels = $porSala->keys()->values()->all();
$chartSalaData = $porSala->values()->all();

$chartHoras = collect($cirugiasHoy)
->groupBy(function ($c) {
return $c->hora_programada
? \Carbon\Carbon::parse($c->hora_programada)->format('H:00')
: 'Sin hora';
})
->map->count()
->sortKeys();

$chartHoraLabels = $chartHoras->keys()->values()->all();
$chartHoraData = $chartHoras->values()->all();

$estadoProgramado = (int) $programadas;
$estadoEnCurso = (int) $enCurso;
$estadoCulminado = (int) $culminadas;
$estadoSolicitado = (int) $solicitadas;
@endphp

<div class="cx-page">
    <div class="cx-container">

        <div class="cx-head">
            <div>
                <h1 class="cx-title">Panel de Control de Cirugías</h1>
                <p class="cx-sub">Resumen operativo, visual y estadístico de todos los registros quirúrgicos.</p>
            </div>

            <div class="cx-top-actions">
                <a class="cx-btn" href="{{ url('/home') }}">Dashboard</a>
                <a class="cx-btn" href="{{ route('cirugias.panel_tv') }}">Panel TV</a>
                <a class="cx-btn cx-btn-primary" href="javascript:void(0)" onclick="window.print()">Imprimir</a>
            </div>
        </div>

        <div class="cx-filter">
            <form method="GET" action="{{ route('cirugias.index') }}" class="cx-filter-form">
                <div class="cx-filter-group">
                    <label>Fecha inicio</label>
                    <input class="cx-input" type="date" name="fecha_inicio" value="{{ $fechaInicio ?? '' }}">
                </div>

                <div class="cx-filter-group">
                    <label>Fecha fin</label>
                    <input class="cx-input" type="date" name="fecha_fin" value="{{ $fechaFin ?? '' }}">
                </div>

                <button type="submit" class="cx-btn cx-btn-primary">Filtrar</button>
                <a href="{{ route('cirugias.index') }}" class="cx-btn">Ver todo</a>

                <div class="cx-count">
                    {{ $textoFiltro }}
                </div>
            </form>
        </div>

        <div class="cx-grid-kpi">
            <div class="cx-card">
                <div class="cx-card-label">Total registros</div>
                <div class="cx-card-value">{{ $totalHoy }}</div>
                <div class="cx-card-note">Cirugías registradas según el filtro aplicado</div>
                <div class="cx-card-mini">
                    <span class="cx-dot blue"></span> Resumen histórico
                </div>
            </div>

            <div class="cx-card">
                <div class="cx-card-label">Programadas</div>
                <div class="cx-card-value">{{ $programadas }}</div>
                <div class="cx-card-note">Pendientes de ejecución</div>
                <div class="cx-card-mini">
                    <span class="cx-dot"></span> En espera de atención
                </div>
            </div>

            <div class="cx-card">
                <div class="cx-card-label">En curso</div>
                <div class="cx-card-value">{{ $enCurso }}</div>
                <div class="cx-card-note">Cirugías actualmente activas</div>
                <div class="cx-card-mini">
                    <span class="cx-dot violet"></span> Ejecución en sala
                </div>
            </div>

            <div class="cx-card">
                <div class="cx-card-label">Culminadas</div>
                <div class="cx-card-value">{{ $culminadas }}</div>
                <div class="cx-card-note">Registradas como finalizadas</div>
                <div class="cx-card-mini">
                    <span class="cx-dot blue"></span> Producción quirúrgica
                </div>
            </div>

            <div class="cx-card">
                <div class="cx-card-label">Emergencias</div>
                <div class="cx-card-value">{{ $emergencias }}</div>
                <div class="cx-card-note">Solicitudes de emergencia</div>
                <div class="cx-card-mini">
                    <span class="cx-dot red"></span> Prioridad crítica
                </div>
            </div>

            <div class="cx-card">
                <div class="cx-card-label">Salas utilizadas</div>
                <div class="cx-card-value">{{ $salasOcupadas }}</div>
                <div class="cx-card-note">Salas distintas registradas</div>
                <div class="cx-card-mini">
                    <span class="cx-dot yellow"></span> Capacidad utilizada
                </div>
            </div>

            <div class="cx-card">
                <div class="cx-card-label">Próxima cirugía</div>
                <div class="cx-card-value" style="font-size:22px;">
                    {{ $proximaCirugia && $proximaCirugia->hora_programada ? \Carbon\Carbon::parse($proximaCirugia->hora_programada)->format('H:i') : '-' }}
                </div>
                <div class="cx-card-note">
                    {{ $proximaCirugia->sala_operacion ?? 'Sin sala' }}
                </div>
                <div class="cx-card-mini">
                    <span class="cx-dot"></span>
                    {{ $proximaCirugia->paciente ?? 'Sin paciente' }}
                </div>
            </div>
        </div>

        <div class="cx-row">
            <div class="cx-panel">
                <div class="cx-panel-head">
                    <div class="cx-panel-title">Distribución por estado</div>
                    <div class="cx-count">Total: {{ $totalHoy }} intervenciones</div>
                </div>
                <div class="cx-panel-body">
                    <div class="cx-chart-box">
                        <canvas id="chartEstados"></canvas>
                    </div>
                </div>
            </div>

            <div class="cx-panel">
                <div class="cx-panel-head">
                    <div class="cx-panel-title">Resumen ejecutivo</div>
                    <div class="cx-count">{{ $textoFiltro }}</div>
                </div>
                <div class="cx-panel-body">
                    <div class="cx-stat-line">
                        <span class="cx-muted">Avance quirúrgico general</span>
                        <span class="cx-strong">{{ $ocupacionPct }}%</span>
                    </div>
                    <div class="cx-progress">
                        <div class="cx-progress-bar" style="width: {{ $ocupacionPct }}%;"></div>
                    </div>

                    <div style="height: 18px;"></div>

                    <div class="cx-stat-line">
                        <span class="cx-muted">Cirugías culminadas</span>
                        <span class="cx-strong">{{ $culminadas }}</span>
                    </div>

                    <div class="cx-stat-line">
                        <span class="cx-muted">Cirugías en curso</span>
                        <span class="cx-strong">{{ $enCurso }}</span>
                    </div>

                    <div class="cx-stat-line">
                        <span class="cx-muted">Pendientes / programadas</span>
                        <span class="cx-strong">{{ $programadas }}</span>
                    </div>

                    <div class="cx-stat-line">
                        <span class="cx-muted">Solicitudes pendientes</span>
                        <span class="cx-strong">{{ $solicitadas }}</span>
                    </div>

                    <div class="cx-stat-line">
                        <span class="cx-muted">Emergencias registradas</span>
                        <span class="cx-strong">{{ $emergencias }}</span>
                    </div>

                    <div class="cx-stat-line" style="margin-bottom:0;">
                        <span class="cx-muted">Salas utilizadas</span>
                        <span class="cx-strong">{{ $salasOcupadas }}</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="cx-row-2">
            <div class="cx-panel">
                <div class="cx-panel-head">
                    <div class="cx-panel-title">Carga por sala</div>
                    <div class="cx-count">{{ $porSala->count() }} salas</div>
                </div>
                <div class="cx-panel-body">
                    <div class="cx-chart-box">
                        <canvas id="chartSalas"></canvas>
                    </div>
                </div>
            </div>

            <div class="cx-panel">
                <div class="cx-panel-head">
                    <div class="cx-panel-title">Flujo horario</div>
                    <div class="cx-count">Programación por hora</div>
                </div>
                <div class="cx-panel-body">
                    <div class="cx-chart-box">
                        <canvas id="chartHoras"></canvas>
                    </div>
                </div>
            </div>

            <div class="cx-panel">
                <div class="cx-panel-head">
                    <div class="cx-panel-title">Próximas cirugías</div>
                    <div class="cx-count">Top 5</div>
                </div>
                <div class="cx-panel-body">
                    <div class="cx-list">
                        @forelse($proximas as $p)
                        <div class="cx-item">
                            <div class="cx-item-top">
                                <div class="cx-item-title">
                                    {{ $fechaMostrar($p) }} -
                                    {{ $p->hora_programada ? \Carbon\Carbon::parse($p->hora_programada)->format('H:i') : '-' }}
                                </div>
                                <span class="cx-badge">
                                    <span class="cx-dot {{ strtoupper($p->tipo_solicitud ?? '') === 'EMERGENCIA' ? 'red' : '' }}"></span>
                                    {{ strtoupper($p->tipo_solicitud ?? 'PROGRAMADA') }}
                                </span>
                            </div>
                            <div class="cx-item-sub"><strong>Paciente:</strong> {{ $p->paciente ?? '-' }}</div>
                            <div class="cx-item-sub"><strong>Operación:</strong> {{ $p->operacion ?? '-' }}</div>
                            <div class="cx-item-sub"><strong>Sala:</strong> {{ $p->sala_operacion ?? '-' }}</div>
                        </div>
                        @empty
                        <div class="cx-empty">No hay registros para mostrar.</div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>

        <div class="cx-row">
            <div class="cx-panel">
                <div class="cx-panel-head">
                    <div class="cx-panel-title">Operaciones registradas</div>
                    <div class="cx-count">Total: {{ $totalHoy }}</div>
                </div>

                <div class="cx-table-wrap">
                    <table class="cx-table">
                        <thead>
                            <tr>
                                <th>Fecha</th>
                                <th>Hora</th>
                                <th>Sala</th>
                                <th>Tipo</th>
                                <th>Paciente</th>
                                <th>Operación</th>
                                <th>Cirujano</th>
                                <th>Estado</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($cirugiasHoy as $c)
                            <tr>
                                <td>{{ $fechaMostrar($c) }}</td>
                                <td>
                                    {{ $c->hora_programada ? \Carbon\Carbon::parse($c->hora_programada)->format('H:i') : '-' }}
                                </td>
                                <td>{{ $c->sala_operacion ?? '-' }}</td>
                                <td>
                                    @if(strtoupper($c->tipo_solicitud ?? '') === 'EMERGENCIA')
                                    <span class="cx-badge">
                                        <span class="cx-dot red"></span> EMERG.
                                    </span>
                                    @else
                                    <span class="cx-badge">
                                        <span class="cx-dot"></span> PROG.
                                    </span>
                                    @endif
                                </td>
                                <td>{{ $c->paciente ?? '-' }}</td>
                                <td>{{ $c->operacion ?? '-' }}</td>
                                <td>{{ $c->cirujano_principal ?? '-' }}</td>
                                <td>
                                    @if($c->estado === 'P')
                                    <span class="cx-state cx-state-p">Programado</span>
                                    @elseif($c->estado === 'E')
                                    <span class="cx-state cx-state-e">En curso</span>
                                    @elseif($c->estado === 'C')
                                    <span class="cx-state cx-state-c">Culminado</span>
                                    @else
                                    <span class="cx-state cx-state-s">Solicitado</span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8" class="cx-empty">
                                    No hay cirugías registradas en el rango seleccionado.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="cx-panel">
                <div class="cx-panel-head">
                    <div class="cx-panel-title">Alertas y ranking rápido</div>
                    <div class="cx-count">Vista lateral</div>
                </div>
                <div class="cx-panel-body">

                    <div class="cx-split">
                        <div class="cx-item">
                            <div class="cx-item-title">Emergencias</div>
                            <div class="cx-item-sub">Casos críticos registrados</div>
                            <div class="cx-card-value" style="font-size: 26px; margin-top: 8px;">{{ $emergencias }}</div>
                        </div>

                        <div class="cx-item">
                            <div class="cx-item-title">Próxima sala</div>
                            <div class="cx-item-sub">Siguiente intervención</div>
                            <div class="cx-card-value" style="font-size: 20px; margin-top: 8px;">
                                {{ $proximaCirugia->sala_operacion ?? '-' }}
                            </div>
                        </div>
                    </div>

                    <div style="height: 14px;"></div>

                    <div class="cx-item">
                        <div class="cx-item-title" style="margin-bottom:10px;">Ranking por sala</div>
                        @forelse($porSala as $sala => $cantidad)
                        @php
                        $porcentajeSala = $totalHoy > 0 ? round(($cantidad / $totalHoy) * 100) : 0;
                        @endphp
                        <div style="margin-bottom: 12px;">
                            <div class="cx-stat-line" style="margin-bottom: 6px;">
                                <span class="cx-muted">{{ $sala }}</span>
                                <span class="cx-strong">{{ $cantidad }}</span>
                            </div>
                            <div class="cx-progress">
                                <div class="cx-progress-bar" style="width: {{ $porcentajeSala }}%;"></div>
                            </div>
                        </div>
                        @empty
                        <div class="cx-empty">Sin información por sala.</div>
                        @endforelse
                    </div>

                    <div style="height: 14px;"></div>

                    <div class="cx-item">
                        <div class="cx-item-title" style="margin-bottom:10px;">Listado de emergencias</div>
                        @forelse($cirugiasEmergencia->take(4) as $e)
                        <div style="padding:8px 0; border-bottom:1px solid rgba(255,255,255,.08);">
                            <div class="cx-item-sub">
                                <strong>{{ $fechaMostrar($e) }}</strong>
                                —
                                <strong>{{ $e->hora_programada ? \Carbon\Carbon::parse($e->hora_programada)->format('H:i') : '-' }}</strong>
                                — {{ $e->paciente ?? '-' }}
                            </div>
                            <div class="cx-item-sub">{{ $e->operacion ?? '-' }}</div>
                        </div>
                        @empty
                        <div class="cx-empty" style="padding: 8px 0 0;">No se registran emergencias.</div>
                        @endforelse
                    </div>

                </div>
            </div>
        </div>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const salaLabels = @json($chartSalaLabels);
        const salaData = @json($chartSalaData);
        const horaLabels = @json($chartHoraLabels);
        const horaData = @json($chartHoraData);

        const estadoProgramado = @json($estadoProgramado);
        const estadoEnCurso = @json($estadoEnCurso);
        const estadoCulminado = @json($estadoCulminado);
        const estadoSolicitado = @json($estadoSolicitado);

        const commonOptions = {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    labels: {
                        color: '#eaf3f8',
                        font: {
                            size: 12,
                            weight: 'bold'
                        }
                    }
                },
                tooltip: {
                    backgroundColor: 'rgba(6, 18, 24, 0.95)',
                    titleColor: '#fff',
                    bodyColor: '#eaf3f8',
                    borderColor: 'rgba(255,255,255,.12)',
                    borderWidth: 1
                }
            },
            scales: {
                x: {
                    ticks: {
                        color: 'rgba(234,243,248,.75)'
                    },
                    grid: {
                        color: 'rgba(255,255,255,.06)'
                    }
                },
                y: {
                    beginAtZero: true,
                    ticks: {
                        color: 'rgba(234,243,248,.75)',
                        precision: 0
                    },
                    grid: {
                        color: 'rgba(255,255,255,.06)'
                    }
                }
            }
        };

        const ctxEstados = document.getElementById('chartEstados');
        const ctxSalas = document.getElementById('chartSalas');
        const ctxHoras = document.getElementById('chartHoras');

        if (ctxEstados) {
            new Chart(ctxEstados, {
                type: 'doughnut',
                data: {
                    labels: ['Programadas', 'En curso', 'Culminadas', 'Solicitadas'],
                    datasets: [{
                        data: [estadoProgramado, estadoEnCurso, estadoCulminado, estadoSolicitado],
                        backgroundColor: [
                            'rgba(43, 212, 197, 0.85)',
                            'rgba(155, 123, 255, 0.85)',
                            'rgba(27, 179, 242, 0.85)',
                            'rgba(255, 211, 107, 0.90)'
                        ],
                        borderColor: [
                            'rgba(43, 212, 197, 1)',
                            'rgba(155, 123, 255, 1)',
                            'rgba(27, 179, 242, 1)',
                            'rgba(255, 211, 107, 1)'
                        ],
                        borderWidth: 2
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    cutout: '60%',
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                color: '#eaf3f8',
                                font: {
                                    size: 12,
                                    weight: 'bold'
                                }
                            }
                        }
                    }
                }
            });
        }

        if (ctxSalas) {
            new Chart(ctxSalas, {
                type: 'bar',
                data: {
                    labels: salaLabels,
                    datasets: [{
                        label: 'Cirugías',
                        data: salaData,
                        backgroundColor: 'rgba(27, 179, 242, 0.65)',
                        borderColor: 'rgba(27, 179, 242, 1)',
                        borderWidth: 1.5,
                        borderRadius: 8
                    }]
                },
                options: commonOptions
            });
        }

        if (ctxHoras) {
            new Chart(ctxHoras, {
                type: 'line',
                data: {
                    labels: horaLabels,
                    datasets: [{
                        label: 'Cirugías por hora',
                        data: horaData,
                        fill: true,
                        tension: 0.35,
                        backgroundColor: 'rgba(43, 212, 197, 0.14)',
                        borderColor: 'rgba(43, 212, 197, 1)',
                        pointBackgroundColor: 'rgba(43, 212, 197, 1)',
                        pointBorderColor: '#fff',
                        pointRadius: 4
                    }]
                },
                options: commonOptions
            });
        }
    });
</script>

<script>
    setTimeout(function() {
        location.reload();
    }, 30000);
</script>
@endsection