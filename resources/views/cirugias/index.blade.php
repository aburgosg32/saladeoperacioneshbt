@extends('layouts.app')

@section('content')
<style>
    :root {
        --bg0: #eef4f2;
        --bg1: #f8fbfa;
        --line: rgba(25, 64, 72, .12);
        --text: #20313a;
        --muted: #6f7f86;
        --primary: #35c89f;
        --primary2: #0f8f9f;
        --warning: #c8952d;
        --success: #2fbe8f;
        --danger: #d64d4d;
        --violet: #7c68c9;
        --shadow: 0 22px 60px rgba(35, 64, 70, .14);
        --shadow2: 0 10px 30px rgba(35, 64, 70, .10);
        --radius: 22px;
    }

    .cx-page {
        min-height: calc(100vh - 80px);
        padding: 32px 0 42px;
        background:
            radial-gradient(900px 520px at 12% 12%, rgba(53, 200, 159, .18), transparent 58%),
            radial-gradient(900px 520px at 92% 18%, rgba(15, 143, 159, .12), transparent 55%),
            linear-gradient(135deg, var(--bg0) 0%, var(--bg1) 48%, #eaf2f0 100%);
        color: var(--text);
        position: relative;
        overflow: hidden;
    }

    .cx-page::before {
        content: "";
        position: absolute;
        inset: 0;
        pointer-events: none;
        opacity: .24;
        background-image:
            linear-gradient(to right, rgba(25, 64, 72, .07) 1px, transparent 1px),
            linear-gradient(to bottom, rgba(25, 64, 72, .07) 1px, transparent 1px);
        background-size: 46px 46px;
        mask-image: radial-gradient(circle at 42% 30%, black 0%, transparent 68%);
    }

    .cx-container {
        width: min(1380px, 96vw);
        margin: 0 auto;
        position: relative;
        z-index: 1;
    }

    .cx-head {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        gap: 16px;
        flex-wrap: wrap;
        margin-bottom: 18px;
    }

    .cx-title {
        margin: 0;
        font-size: 30px;
        font-weight: 900;
        letter-spacing: -.4px;
        color: #172f3a;
    }

    .cx-sub {
        margin: 6px 0 0;
        color: var(--muted);
        font-size: 13.5px;
        line-height: 1.7;
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
        border-radius: 15px;
        border: 1px solid rgba(25, 64, 72, .10);
        background: rgba(255, 255, 255, .78);
        color: #253c45;
        text-decoration: none;
        font-size: 12.5px;
        font-weight: 900;
        transition: .15s ease;
        cursor: pointer;
    }

    .cx-btn:hover {
        transform: translateY(-1px);
        background: #ffffff;
        border-color: rgba(53, 200, 159, .30);
        box-shadow: 0 10px 26px rgba(35, 64, 70, .10);
        color: #253c45;
        text-decoration: none;
    }

    .cx-btn-primary {
        border-color: rgba(53, 200, 159, .44);
        background: linear-gradient(135deg, #35c89f, #13a889);
        color: #ffffff;
        box-shadow: 0 12px 26px rgba(53, 200, 159, .20);
    }

    .cx-btn-primary:hover {
        background: linear-gradient(135deg, #39d6aa, #0f9f83);
        color: #ffffff;
    }

    .cx-filter {
        margin-bottom: 18px;
        border: 1px solid var(--line);
        border-radius: var(--radius);
        background:
            radial-gradient(500px 260px at 16% 12%, rgba(53, 200, 159, .08), transparent 58%),
            linear-gradient(180deg, rgba(255, 255, 255, .94), rgba(255, 255, 255, .76));
        box-shadow: var(--shadow2);
        padding: 16px;
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
        color: #29414a;
        font-size: 11.5px;
        font-weight: 900;
        text-transform: uppercase;
        letter-spacing: .5px;
        margin: 0;
    }

    .cx-input {
        min-width: 170px;
        padding: 10px 12px;
        border-radius: 15px;
        border: 1px solid rgba(25, 64, 72, .10);
        background: rgba(255, 255, 255, .88);
        color: #20313a;
        outline: none;
        font-size: 13px;
        font-weight: 700;
    }

    .cx-input:focus {
        border-color: rgba(53, 200, 159, .55);
        background: #ffffff;
        box-shadow: 0 0 0 4px rgba(53, 200, 159, .10);
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
        border-radius: var(--radius);
        background:
            radial-gradient(500px 260px at 16% 12%, rgba(53, 200, 159, .10), transparent 58%),
            linear-gradient(180deg, rgba(255, 255, 255, .94), rgba(255, 255, 255, .76));
        box-shadow: var(--shadow2);
        padding: 18px;
        position: relative;
        overflow: hidden;
    }

    .cx-card::after {
        content: "";
        position: absolute;
        right: -30px;
        top: -30px;
        width: 110px;
        height: 110px;
        border-radius: 50%;
        background: radial-gradient(circle, rgba(53, 200, 159, .16), transparent 65%);
        pointer-events: none;
    }

    .cx-card-label {
        color: var(--muted);
        font-size: 11.5px;
        font-weight: 900;
        margin-bottom: 8px;
        text-transform: uppercase;
        letter-spacing: .6px;
        position: relative;
        z-index: 1;
    }

    .cx-card-value {
        font-size: 30px;
        font-weight: 900;
        line-height: 1;
        color: #172f3a;
        position: relative;
        z-index: 1;
    }

    .cx-card-note {
        margin-top: 8px;
        font-size: 12px;
        color: var(--muted);
        font-weight: 700;
        position: relative;
        z-index: 1;
    }

    .cx-card-mini {
        margin-top: 10px;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 5px 9px;
        border-radius: 999px;
        font-size: 11px;
        font-weight: 900;
        border: 1px solid rgba(25, 64, 72, .10);
        background: rgba(255, 255, 255, .72);
        color: #40545c;
        position: relative;
        z-index: 1;
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
        border-radius: var(--radius);
        background:
            radial-gradient(500px 260px at 16% 12%, rgba(53, 200, 159, .08), transparent 58%),
            linear-gradient(180deg, rgba(255, 255, 255, .94), rgba(255, 255, 255, .76));
        box-shadow: var(--shadow);
        overflow: hidden;
        backdrop-filter: blur(14px);
    }

    .cx-panel-head {
        padding: 14px 16px;
        border-bottom: 1px solid rgba(25, 64, 72, .10);
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 12px;
        flex-wrap: wrap;
        background: rgba(255, 255, 255, .52);
    }

    .cx-panel-title {
        font-weight: 900;
        font-size: 14px;
        letter-spacing: .3px;
        color: #17313b;
    }

    .cx-count {
        color: #227e70;
        font-size: 12px;
        font-weight: 900;
        border: 1px solid rgba(53, 200, 159, .24);
        padding: 6px 10px;
        border-radius: 999px;
        background: rgba(53, 200, 159, .10);
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
        border-bottom: 1px solid rgba(25, 64, 72, .08);
        font-size: 12.5px;
        vertical-align: middle;
    }

    .cx-table th {
        color: #29414a;
        font-weight: 900;
        font-size: 12px;
        text-transform: uppercase;
        letter-spacing: .45px;
        background: rgba(255, 255, 255, .66);
    }

    .cx-table td {
        color: #40545c;
    }

    .cx-table tr:hover td {
        background: rgba(53, 200, 159, .045);
    }

    .cx-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 5px 8px;
        border-radius: 999px;
        border: 1px solid rgba(25, 64, 72, .10);
        background: rgba(255, 255, 255, .72);
        color: #40545c;
        font-size: 11px;
        font-weight: 900;
        letter-spacing: .2px;
        white-space: nowrap;
    }

    .cx-dot {
        width: 8px;
        height: 8px;
        border-radius: 999px;
        background: var(--primary);
        box-shadow: 0 0 0 4px rgba(53, 200, 159, .12);
    }

    .cx-dot.red {
        background: var(--danger);
        box-shadow: 0 0 0 4px rgba(214, 77, 77, .12);
    }

    .cx-dot.blue {
        background: var(--primary2);
        box-shadow: 0 0 0 4px rgba(15, 143, 159, .12);
    }

    .cx-dot.yellow {
        background: var(--warning);
        box-shadow: 0 0 0 4px rgba(200, 149, 45, .12);
    }

    .cx-dot.violet {
        background: var(--violet);
        box-shadow: 0 0 0 4px rgba(124, 104, 201, .12);
    }

    .cx-state {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 5px 10px;
        border-radius: 999px;
        font-size: 11px;
        font-weight: 900;
        border: 1px solid rgba(25, 64, 72, .10);
        white-space: nowrap;
    }

    .cx-state-p {
        background: rgba(53, 200, 159, .12);
        color: #1f8f77;
        border-color: rgba(53, 200, 159, .30);
    }

    .cx-state-e {
        background: rgba(124, 104, 201, .12);
        color: #6753b0;
        border-color: rgba(124, 104, 201, .24);
    }

    .cx-state-c {
        background: rgba(15, 143, 159, .12);
        color: #0b7f8e;
        border-color: rgba(15, 143, 159, .24);
    }

    .cx-state-s {
        background: rgba(200, 149, 45, .12);
        color: #9b6d13;
        border-color: rgba(200, 149, 45, .22);
    }

    .cx-list {
        display: grid;
        gap: 12px;
    }

    .cx-item {
        border: 1px solid rgba(25, 64, 72, .10);
        border-radius: 16px;
        padding: 12px;
        background: rgba(255, 255, 255, .66);
        box-shadow: 0 8px 24px rgba(35, 64, 70, .07);
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
        color: #17313b;
    }

    .cx-item-sub {
        font-size: 12px;
        color: var(--muted);
        line-height: 1.5;
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
        background: rgba(25, 64, 72, .08);
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
        color: #17313b;
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
                <a class="cx-btn" href="{{ route('home') }}">Menu Principal</a>
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
                            <div class="cx-card-value" style="font-size: 26px; margin-top: 8px;">
                                {{ $emergencias }}
                            </div>
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
                        <div style="padding:8px 0; border-bottom:1px solid rgba(25,64,72,.10);">
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
                        color: '#20313a',
                        font: {
                            size: 12,
                            weight: 'bold'
                        }
                    }
                },
                tooltip: {
                    backgroundColor: 'rgba(23, 47, 58, 0.95)',
                    titleColor: '#ffffff',
                    bodyColor: '#f8fbfa',
                    borderColor: 'rgba(25,64,72,.12)',
                    borderWidth: 1
                }
            },
            scales: {
                x: {
                    ticks: {
                        color: '#6f7f86'
                    },
                    grid: {
                        color: 'rgba(25,64,72,.08)'
                    }
                },
                y: {
                    beginAtZero: true,
                    ticks: {
                        color: '#6f7f86',
                        precision: 0
                    },
                    grid: {
                        color: 'rgba(25,64,72,.08)'
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
                        data: [
                            estadoProgramado,
                            estadoEnCurso,
                            estadoCulminado,
                            estadoSolicitado
                        ],
                        backgroundColor: [
                            'rgba(53, 200, 159, 0.85)',
                            'rgba(124, 104, 201, 0.85)',
                            'rgba(15, 143, 159, 0.85)',
                            'rgba(200, 149, 45, 0.90)'
                        ],
                        borderColor: [
                            'rgba(53, 200, 159, 1)',
                            'rgba(124, 104, 201, 1)',
                            'rgba(15, 143, 159, 1)',
                            'rgba(200, 149, 45, 1)'
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
                                color: '#20313a',
                                font: {
                                    size: 12,
                                    weight: 'bold'
                                }
                            }
                        },
                        tooltip: {
                            backgroundColor: 'rgba(23, 47, 58, 0.95)',
                            titleColor: '#ffffff',
                            bodyColor: '#f8fbfa',
                            borderColor: 'rgba(25,64,72,.12)',
                            borderWidth: 1
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
                        backgroundColor: 'rgba(15, 143, 159, 0.65)',
                        borderColor: 'rgba(15, 143, 159, 1)',
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
                        backgroundColor: 'rgba(53, 200, 159, 0.14)',
                        borderColor: 'rgba(53, 200, 159, 1)',
                        pointBackgroundColor: 'rgba(53, 200, 159, 1)',
                        pointBorderColor: '#ffffff',
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