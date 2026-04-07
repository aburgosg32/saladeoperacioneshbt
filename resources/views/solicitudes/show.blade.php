@extends('layouts.app')

@section('content')
<style>
    .or-page {
        min-height: calc(100vh - 80px);
        padding: 28px 0;
        background:
            radial-gradient(1100px 650px at 12% 10%, rgba(43, 212, 197, .10), transparent 60%),
            radial-gradient(900px 520px at 90% 15%, rgba(27, 179, 242, .10), transparent 55%),
            linear-gradient(180deg, #061218, #0a1d28);
        color: #eaf3f8;
    }

    .or-container {
        width: min(1000px, 92vw);
        margin: 0 auto;
    }

    .or-head {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }

    .or-title {
        font-size: 22px;
        font-weight: 900;
        margin: 0;
    }

    .or-btn {
        padding: 8px 14px;
        border-radius: 12px;
        border: 1px solid rgba(255, 255, 255, .15);
        background: rgba(12, 40, 56, .35);
        color: #eaf3f8;
        text-decoration: none;
        font-size: 13px;
        font-weight: 700;
    }

    .or-btn:hover {
        border-color: #1bb3f2;
        background: rgba(12, 40, 56, .6);
    }

    .or-list {
        line-height: 1.9;
        font-size: 14px;
    }

    .or-label {
        font-weight: 900;
        color: rgba(234, 243, 248, .85);
        display: inline-block;
        width: 170px;
    }

    .or-value {
        color: #eaf3f8;
    }

    .or-section {
        margin-top: 16px;
        padding-top: 12px;
        border-top: 1px solid rgba(255, 255, 255, .08);
    }

    .or-section-title {
        font-weight: 900;
        margin-bottom: 6px;
        color: #2bd4c5;
        font-size: 13px;
        letter-spacing: .3px;
    }
</style>

<div class="or-page">
    <div class="or-container">

        <div class="or-head">
            <h1 class="or-title">Solicitud #{{ $solicitud->id }}</h1>

            <div>
                <a class="or-btn" href="{{ route('solicitudes.index') }}">Volver</a>
                <a class="or-btn" href="{{ route('solicitudes.edit', $solicitud) }}">Editar</a>
            </div>
        </div>

        <div class="or-list">

            <div>
                <span class="or-label">Tipo</span>
                <span class="or-value">{{ $solicitud->tipo_solicitud }}</span>
            </div>

            <div>
                <span class="or-label">Estado</span>
                <span class="or-value">
                    @if($solicitud->estado == 'P')
                    Programado
                    @elseif($solicitud->estado == 'C')
                    Culminado
                    @else
                    Solicitado
                    @endif
                </span>
            </div>

            <div>
                <span class="or-label">Intervención</span>
                <span class="or-value">{{ $solicitud->intervencion ?? '-' }}</span>
            </div>

            <div>
                <span class="or-label">Fecha / Hora</span>
                <span class="or-value">
                    {{ $solicitud->para_el_dia ? date('d/m/Y',strtotime($solicitud->para_el_dia)) : '-' }}
                    {{ $solicitud->a_horas ? date('H:i',strtotime($solicitud->a_horas)) : '' }}
                </span>
            </div>

            <div>
                <span class="or-label">Servicio</span>
                <span class="or-value">{{ $solicitud->servicio ?? '-' }}</span>
            </div>

            <div>
                <span class="or-label">HC</span>
                <span class="or-value">{{ $solicitud->n_historia ?? '-' }}</span>
            </div>

            <div>
                <span class="or-label">Paciente</span>
                <span class="or-value">{{ $solicitud->paciente ?? '-' }} ({{ $solicitud->edad ?? '-' }} años)</span>
            </div>

            <div>
                <span class="or-label">Cama</span>
                <span class="or-value">{{ $solicitud->cama ?? '-' }}</span>
            </div>

            {{-- DIAGNÓSTICO --}}
            <div class="or-section">
                <div class="or-section-title">Diagnóstico</div>

                <div>
                    <span class="or-label">Código</span>
                    <span class="or-value">{{ $solicitud->codigo_diagnostico ?? '-' }}</span>
                </div>

                <div>
                    <span class="or-label">Dx</span>
                    <span class="or-value">{{ $solicitud->diagnostico ?? '-' }}</span>
                </div>
            </div>

            {{-- OPERACIÓN --}}
            <div class="or-section">
                <div class="or-section-title">Operación</div>

                <div>
                    <span class="or-label">Código</span>
                    <span class="or-value">{{ $solicitud->codigo_operacion ?? '-' }}</span>
                </div>

                <div>
                    <span class="or-label">Operación</span>
                    <span class="or-value">{{ $solicitud->operacion ?? '-' }}</span>
                </div>
            </div>

            {{-- LABORATORIO --}}
            <div class="or-section">
                <div class="or-section-title">Laboratorio</div>

                <div>
                    <span class="or-label">Hto / Hb</span>
                    <span class="or-value">{{ $solicitud->hto ?? '-' }} / {{ $solicitud->hb ?? '-' }}</span>
                </div>

                <div>
                    <span class="or-label">GS / Rh</span>
                    <span class="or-value">{{ $solicitud->gs ?? '-' }} / {{ $solicitud->rh ?? '-' }}</span>
                </div>
            </div>

            {{-- EQUIPO --}}
            <div class="or-section">
                <div class="or-section-title">Equipo Quirúrgico</div>

                <div><span class="or-label">Cirujano</span><span class="or-value">{{ $solicitud->cirujano_principal ?? '-' }}</span></div>
                <div><span class="or-label">1er Ayudante</span><span class="or-value">{{ $solicitud->primer_ayudante ?? '-' }}</span></div>
                <div><span class="or-label">2do Ayudante</span><span class="or-value">{{ $solicitud->segundo_ayudante ?? '-' }}</span></div>
                <div><span class="or-label">3er Ayudante</span><span class="or-value">{{ $solicitud->tercer_ayudante ?? '-' }}</span></div>
                <div><span class="or-label">Instrumentista</span><span class="or-value">{{ $solicitud->instrumentista ?? '-' }}</span></div>
            </div>

            {{-- DATOS QUIRÚRGICOS --}}
            <div class="or-section">
                <div class="or-section-title">Datos quirúrgicos</div>

                <div><span class="or-label">Tiempo Operativo</span><span class="or-value">{{ $solicitud->tiempo_operativo_aprox ?? '-' }}</span></div>
                <div><span class="or-label">Posición</span><span class="or-value">{{ $solicitud->posicion_paciente ?? '-' }}</span></div>
            </div>

            {{-- PROGRAMACIÓN --}}
            <div class="or-section">
                <div class="or-section-title">Programación de Sala</div>

                <div>
                    <span class="or-label">Fecha Programada</span>
                    <span class="or-value">{{ $solicitud->fecha_programada ? date('d/m/Y', strtotime($solicitud->fecha_programada)) : '-' }}</span>
                </div>

                <div>
                    <span class="or-label">Hora Programada</span>
                    <span class="or-value">{{ $solicitud->hora_programada ? date('H:i', strtotime($solicitud->hora_programada)) : '-' }}</span>
                </div>

                <div>
                    <span class="or-label">Sala de Operación</span>
                    <span class="or-value">{{ $solicitud->sala_operacion ?? '-' }}</span>
                </div>
            </div>

            {{-- CULMINACIÓN --}}
            <div class="or-section">
                <div class="or-section-title">Culminación de Operación</div>

                <div>
                    <span class="or-label">Fecha Culminación</span>
                    <span class="or-value">{{ $solicitud->fecha_culminacion ? date('d/m/Y', strtotime($solicitud->fecha_culminacion)) : '-' }}</span>
                </div>

                <div>
                    <span class="or-label">Hora Culminación</span>
                    <span class="or-value">{{ $solicitud->hora_culminacion ? date('H:i', strtotime($solicitud->hora_culminacion)) : '-' }}</span>
                </div>

                <div>
                    <span class="or-label">Observación Final</span>
                    <span class="or-value">{{ $solicitud->observacion_culminacion ?? '-' }}</span>
                </div>
            </div>

        </div>

    </div>
</div>

@endsection