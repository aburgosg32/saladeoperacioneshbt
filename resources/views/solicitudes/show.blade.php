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
        --ok: #2fbe8f;
        --danger: #d64d4d;
        --warning: #c8952d;
        --violet: #7c68c9;
        --shadow: 0 22px 60px rgba(35, 64, 70, .14);
        --shadow2: 0 10px 30px rgba(35, 64, 70, .10);
        --radius: 22px;
    }

    .or-page {
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

    .or-page::before {
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

    .or-container {
        width: min(1100px, 94vw);
        margin: 0 auto;
        position: relative;
        z-index: 1;
    }

    .or-head {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        gap: 16px;
        flex-wrap: wrap;
        margin-bottom: 18px;
    }

    .or-title {
        margin: 0;
        font-size: 26px;
        font-weight: 900;
        color: #172f3a;
        letter-spacing: -.4px;
    }

    .or-sub {
        margin: 6px 0 0;
        color: var(--muted);
        font-size: 13.5px;
        line-height: 1.7;
    }

    .or-actions {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
    }

    .or-btn {
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
    }

    .or-btn:hover {
        transform: translateY(-1px);
        background: #ffffff;
        border-color: rgba(53, 200, 159, .30);
        box-shadow: 0 10px 26px rgba(35, 64, 70, .10);
        color: #253c45;
        text-decoration: none;
    }

    .or-btn-primary {
        border-color: rgba(53, 200, 159, .44);
        background: linear-gradient(135deg, #35c89f, #13a889);
        color: #ffffff;
        box-shadow: 0 12px 26px rgba(53, 200, 159, .20);
    }

    .or-btn-primary:hover {
        background: linear-gradient(135deg, #39d6aa, #0f9f83);
        color: #ffffff;
    }

    .or-panel {
        border: 1px solid var(--line);
        border-radius: var(--radius);
        background:
            radial-gradient(500px 260px at 16% 12%, rgba(53, 200, 159, .08), transparent 58%),
            linear-gradient(180deg, rgba(255, 255, 255, .94), rgba(255, 255, 255, .78));
        box-shadow: var(--shadow);
        overflow: hidden;
        backdrop-filter: blur(14px);
    }

    .or-panel-head {
        padding: 16px;
        border-bottom: 1px solid rgba(25, 64, 72, .10);
        background: rgba(255, 255, 255, .56);
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 12px;
        flex-wrap: wrap;
    }

    .or-panel-title {
        font-size: 14px;
        font-weight: 900;
        color: #17313b;
        letter-spacing: .4px;
        text-transform: uppercase;
    }

    .or-badges {
        display: flex;
        gap: 8px;
        flex-wrap: wrap;
    }

    .or-badge {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 6px 11px;
        border-radius: 999px;
        font-size: 11px;
        font-weight: 900;
        border: 1px solid rgba(25, 64, 72, .10);
        background: rgba(255, 255, 255, .72);
        color: #40545c;
        white-space: nowrap;
    }

    .or-badge-emergencia {
        background: rgba(214, 77, 77, .10);
        color: #b43d3d;
        border-color: rgba(214, 77, 77, .25);
    }

    .or-badge-programada {
        background: rgba(53, 200, 159, .12);
        color: #1f8f77;
        border-color: rgba(53, 200, 159, .30);
    }

    .or-state-s {
        background: rgba(200, 149, 45, .12);
        color: #9b6d13;
        border-color: rgba(200, 149, 45, .22);
    }

    .or-state-p {
        background: rgba(53, 200, 159, .12);
        color: #1f8f77;
        border-color: rgba(53, 200, 159, .30);
    }

    .or-state-e {
        background: rgba(124, 104, 201, .12);
        color: #6753b0;
        border-color: rgba(124, 104, 201, .24);
    }

    .or-state-c {
        background: rgba(15, 143, 159, .12);
        color: #0b7f8e;
        border-color: rgba(15, 143, 159, .24);
    }

    .or-panel-body {
        padding: 16px;
    }

    .or-grid {
        display: grid;
        grid-template-columns: repeat(12, 1fr);
        gap: 12px;
    }

    .or-card {
        grid-column: span 12;
        border: 1px solid rgba(25, 64, 72, .10);
        border-radius: 18px;
        background: rgba(255, 255, 255, .66);
        box-shadow: var(--shadow2);
        overflow: hidden;
    }

    .or-card-head {
        padding: 12px 14px;
        border-bottom: 1px solid rgba(25, 64, 72, .10);
        background: rgba(255, 255, 255, .52);
        font-size: 12px;
        font-weight: 900;
        color: #0b7f8e;
        letter-spacing: .4px;
        text-transform: uppercase;
    }

    .or-card-body {
        padding: 14px;
        display: grid;
        grid-template-columns: repeat(12, 1fr);
        gap: 10px;
    }

    .or-item {
        grid-column: span 6;
        border: 1px solid rgba(25, 64, 72, .08);
        border-radius: 15px;
        background: rgba(255, 255, 255, .70);
        padding: 10px 12px;
    }

    .or-item-full {
        grid-column: span 12;
    }

    .or-label {
        display: block;
        font-size: 11px;
        font-weight: 900;
        letter-spacing: .4px;
        text-transform: uppercase;
        color: #29414a;
        margin-bottom: 5px;
    }

    .or-value {
        color: #40545c;
        font-size: 13.5px;
        font-weight: 700;
        line-height: 1.55;
        word-break: break-word;
    }

    .or-value-strong {
        color: #17313b;
        font-weight: 900;
    }

    @media (max-width: 800px) {
        .or-item {
            grid-column: span 12;
        }
    }
</style>

@php
$estadoTexto = 'Solicitado';
$estadoClase = 'or-state-s';

if ($solicitud->estado === 'P') {
$estadoTexto = 'Programado';
$estadoClase = 'or-state-p';
} elseif ($solicitud->estado === 'E') {
$estadoTexto = 'En curso';
$estadoClase = 'or-state-e';
} elseif ($solicitud->estado === 'C') {
$estadoTexto = 'Culminado';
$estadoClase = 'or-state-c';
}

$tipoClase = $solicitud->tipo_solicitud === 'EMERGENCIA'
? 'or-badge-emergencia'
: 'or-badge-programada';
@endphp

<div class="or-page">
    <div class="or-container">

        <div class="or-head">
            <div>
                <h1 class="or-title">Solicitud #{{ $solicitud->id }}</h1>
                <p class="or-sub">Detalle completo de la solicitud de sala de operaciones.</p>
            </div>

            <div class="or-actions">
                <a class="or-btn" href="{{ route('solicitudes.index') }}">Volver</a>

                @can('solicitudes.editar')
                <a class="or-btn or-btn-primary" href="{{ route('solicitudes.edit', $solicitud) }}">Editar</a>
                @endcan
            </div>
        </div>

        <div class="or-panel">
            <div class="or-panel-head">
                <div class="or-panel-title">Información de solicitud</div>

                <div class="or-badges">
                    <span class="or-badge {{ $tipoClase }}">
                        {{ $solicitud->tipo_solicitud ?? '-' }}
                    </span>

                    <span class="or-badge {{ $estadoClase }}">
                        {{ $estadoTexto }}
                    </span>
                </div>
            </div>

            <div class="or-panel-body">
                <div class="or-grid">

                    <div class="or-card">
                        <div class="or-card-head">Datos generales</div>
                        <div class="or-card-body">
                            <div class="or-item">
                                <span class="or-label">Intervención</span>
                                <span class="or-value">{{ $solicitud->intervencion ?? '-' }}</span>
                            </div>

                            <div class="or-item">
                                <span class="or-label">Fecha / Hora solicitada</span>
                                <span class="or-value">
                                    {{ $solicitud->para_el_dia ? date('d/m/Y', strtotime($solicitud->para_el_dia)) : '-' }}
                                    {{ $solicitud->a_horas ? date('H:i', strtotime($solicitud->a_horas)) : '' }}
                                </span>
                            </div>

                            <div class="or-item">
                                <span class="or-label">Servicio</span>
                                <span class="or-value">{{ $solicitud->servicio ?? '-' }}</span>
                            </div>

                            <div class="or-item">
                                <span class="or-label">Cama</span>
                                <span class="or-value">{{ $solicitud->cama ?? '-' }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="or-card">
                        <div class="or-card-head">Paciente</div>
                        <div class="or-card-body">
                            <div class="or-item">
                                <span class="or-label">Historia Clínica</span>
                                <span class="or-value">{{ $solicitud->n_historia ?? '-' }}</span>
                            </div>

                            <div class="or-item">
                                <span class="or-label">Edad</span>
                                <span class="or-value">{{ $solicitud->edad ?? '-' }} años</span>
                            </div>

                            <div class="or-item or-item-full">
                                <span class="or-label">Paciente</span>
                                <span class="or-value or-value-strong">{{ $solicitud->paciente ?? '-' }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="or-card">
                        <div class="or-card-head">Diagnóstico</div>
                        <div class="or-card-body">
                            <div class="or-item">
                                <span class="or-label">Código CIE10</span>
                                <span class="or-value">{{ $solicitud->codigo_diagnostico ?? '-' }}</span>
                            </div>

                            <div class="or-item or-item-full">
                                <span class="or-label">Diagnóstico</span>
                                <span class="or-value">{{ $solicitud->diagnostico ?? '-' }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="or-card">
                        <div class="or-card-head">Operación</div>
                        <div class="or-card-body">
                            <div class="or-item">
                                <span class="or-label">Código CPT</span>
                                <span class="or-value">{{ $solicitud->codigo_operacion ?? '-' }}</span>
                            </div>

                            <div class="or-item or-item-full">
                                <span class="or-label">Operación</span>
                                <span class="or-value">{{ $solicitud->operacion ?? '-' }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="or-card">
                        <div class="or-card-head">Laboratorio</div>
                        <div class="or-card-body">
                            <div class="or-item">
                                <span class="or-label">Hto / Hb</span>
                                <span class="or-value">{{ $solicitud->hto ?? '-' }} / {{ $solicitud->hb ?? '-' }}</span>
                            </div>

                            <div class="or-item">
                                <span class="or-label">GS / Rh</span>
                                <span class="or-value">{{ $solicitud->gs ?? '-' }} / {{ $solicitud->rh ?? '-' }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="or-card">
                        <div class="or-card-head">Equipo quirúrgico</div>
                        <div class="or-card-body">
                            <div class="or-item or-item-full">
                                <span class="or-label">Cirujano principal</span>
                                <span class="or-value or-value-strong">{{ $solicitud->cirujano_principal ?? '-' }}</span>
                            </div>

                            <div class="or-item">
                                <span class="or-label">1er Ayudante</span>
                                <span class="or-value">{{ $solicitud->primer_ayudante ?? '-' }}</span>
                            </div>

                            <div class="or-item">
                                <span class="or-label">2do Ayudante</span>
                                <span class="or-value">{{ $solicitud->segundo_ayudante ?? '-' }}</span>
                            </div>

                            <div class="or-item">
                                <span class="or-label">3er Ayudante</span>
                                <span class="or-value">{{ $solicitud->tercer_ayudante ?? '-' }}</span>
                            </div>

                            <div class="or-item">
                                <span class="or-label">Instrumentista</span>
                                <span class="or-value">{{ $solicitud->instrumentista ?? '-' }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="or-card">
                        <div class="or-card-head">Datos quirúrgicos</div>
                        <div class="or-card-body">
                            <div class="or-item">
                                <span class="or-label">Tiempo operativo aproximado</span>
                                <span class="or-value">{{ $solicitud->tiempo_operativo_aprox ?? '-' }}</span>
                            </div>

                            <div class="or-item">
                                <span class="or-label">Posición del paciente</span>
                                <span class="or-value">{{ $solicitud->posicion_paciente ?? '-' }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="or-card">
                        <div class="or-card-head">Programación de sala</div>
                        <div class="or-card-body">
                            <div class="or-item">
                                <span class="or-label">Fecha programada</span>
                                <span class="or-value">
                                    {{ $solicitud->fecha_programada ? date('d/m/Y', strtotime($solicitud->fecha_programada)) : '-' }}
                                </span>
                            </div>

                            <div class="or-item">
                                <span class="or-label">Hora programada</span>
                                <span class="or-value">
                                    {{ $solicitud->hora_programada ? date('H:i', strtotime($solicitud->hora_programada)) : '-' }}
                                </span>
                            </div>

                            <div class="or-item">
                                <span class="or-label">Sala de operación</span>
                                <span class="or-value or-value-strong">{{ $solicitud->sala_operacion ?? '-' }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="or-card">
                        <div class="or-card-head">Inicio de operación</div>
                        <div class="or-card-body">
                            <div class="or-item">
                                <span class="or-label">Fecha inicio</span>
                                <span class="or-value">
                                    {{ $solicitud->fecha_inicio ? date('d/m/Y', strtotime($solicitud->fecha_inicio)) : '-' }}
                                </span>
                            </div>

                            <div class="or-item">
                                <span class="or-label">Hora inicio</span>
                                <span class="or-value">
                                    {{ $solicitud->hora_inicio ? date('H:i', strtotime($solicitud->hora_inicio)) : '-' }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="or-card">
                        <div class="or-card-head">Culminación de operación</div>
                        <div class="or-card-body">
                            <div class="or-item">
                                <span class="or-label">Fecha culminación</span>
                                <span class="or-value">
                                    {{ $solicitud->fecha_culminacion ? date('d/m/Y', strtotime($solicitud->fecha_culminacion)) : '-' }}
                                </span>
                            </div>

                            <div class="or-item">
                                <span class="or-label">Hora culminación</span>
                                <span class="or-value">
                                    {{ $solicitud->hora_culminacion ? date('H:i', strtotime($solicitud->hora_culminacion)) : '-' }}
                                </span>
                            </div>

                            <div class="or-item or-item-full">
                                <span class="or-label">Observación final</span>
                                <span class="or-value">{{ $solicitud->observacion_culminacion ?? '-' }}</span>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>
</div>

@endsection