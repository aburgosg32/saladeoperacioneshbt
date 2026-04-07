@extends('layouts.app')

@section('content')
<style>
    :root {
        --bg0: #061218;
        --bg1: #0a1d28;
        --line: rgba(255, 255, 255, .12);
        --text: #eaf3f8;
        --muted: rgba(234, 243, 248, .72);
        --shadow: 0 18px 60px rgba(0, 0, 0, .45);
        --radius: 18px;
    }

    .or-page {
        min-height: calc(100vh - 80px);
        padding: 22px 0 34px;
        background:
            radial-gradient(1100px 650px at 12% 10%, rgba(43, 212, 197, .10), transparent 60%),
            radial-gradient(900px 520px at 90% 15%, rgba(27, 179, 242, .10), transparent 55%),
            linear-gradient(180deg, var(--bg0), var(--bg1));
        color: var(--text);
    }

    .or-container {
        width: min(900px, 92vw);
        margin: 0 auto;
    }

    .or-head {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 12px;
        flex-wrap: wrap;
        margin-bottom: 14px;
    }

    .or-title {
        margin: 0;
        font-size: 22px;
        font-weight: 900;
        letter-spacing: -.2px;
    }

    .or-sub {
        margin: 6px 0 0;
        color: var(--muted);
        font-size: 12.5px;
        line-height: 1.6;
    }

    .or-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        padding: 10px 14px;
        border-radius: 14px;
        border: 1px solid var(--line);
        background: rgba(12, 40, 56, .35);
        color: var(--text);
        text-decoration: none;
        font-size: 12.5px;
        font-weight: 800;
        white-space: nowrap;
    }

    .or-btn:hover {
        border-color: rgba(27, 179, 242, .45);
        background: rgba(12, 40, 56, .55);
        color: var(--text);
    }

    .or-btn-primary {
        border-color: rgba(43, 212, 197, .60);
        background: linear-gradient(135deg, rgba(43, 212, 197, .18), rgba(27, 179, 242, .14));
        cursor: pointer;
    }

    .or-panel {
        border: 1px solid var(--line);
        border-radius: var(--radius);
        background:
            radial-gradient(900px 420px at 18% 20%, rgba(43, 212, 197, .10), transparent 55%),
            radial-gradient(700px 420px at 85% 30%, rgba(27, 179, 242, .08), transparent 55%),
            linear-gradient(180deg, rgba(12, 40, 56, .78), rgba(12, 40, 56, .40));
        box-shadow: var(--shadow);
        overflow: hidden;
    }

    .or-panel-head {
        padding: 14px 16px;
        border-bottom: 1px solid var(--line);
        font-weight: 900;
        font-size: 13px;
    }

    .or-panel-body {
        padding: 16px;
    }

    .or-grid {
        display: grid;
        grid-template-columns: repeat(12, 1fr);
        gap: 12px;
    }

    .field {
        border: 1px solid rgba(255, 255, 255, .10);
        background: rgba(12, 40, 56, .22);
        border-radius: 16px;
        padding: 10px 10px 12px;
    }

    .field label {
        display: block;
        font-size: 11px;
        font-weight: 900;
        text-transform: uppercase;
        color: rgba(234, 243, 248, .80);
        margin-bottom: 6px;
    }

    .input,
    .textarea {
        width: 100%;
        border-radius: 14px;
        border: 1px solid rgba(255, 255, 255, .10);
        background: rgba(6, 18, 24, .35);
        color: var(--text);
        padding: 10px 10px;
        outline: none;
        font-size: 13px;
    }

    .textarea {
        min-height: 90px;
        resize: vertical;
    }

    .c12 {
        grid-column: span 12;
    }

    .c6 {
        grid-column: span 6;
    }

    @media (max-width: 900px) {
        .c6 {
            grid-column: span 12;
        }
    }

    .or-resumen {
        margin-bottom: 14px;
        font-size: 13px;
        line-height: 1.7;
        color: rgba(234, 243, 248, .9);
    }

    .server-error {
        border: 1px solid rgba(255, 107, 107, .35);
        background: rgba(255, 107, 107, .08);
        color: rgba(234, 243, 248, .92);
        padding: 12px 14px;
        border-radius: 16px;
        font-size: 12.5px;
        font-weight: 700;
        margin-bottom: 12px;
    }
</style>

<div class="or-page">
    <div class="or-container">

        <div class="or-head">
            <div>
                <h1 class="or-title">Culminar Operación</h1>
                <p class="or-sub">Registro final de culminación quirúrgica.</p>
            </div>

            <div>
                <a class="or-btn" href="{{ route('solicitudes.index') }}">Volver</a>
            </div>
        </div>

        @if ($errors->any())
        <div class="server-error">
            Revisa los campos obligatorios para culminar la operación.
        </div>
        @endif

        <div class="or-panel">
            <div class="or-panel-head">
                Solicitud #{{ $solicitud->id }}
            </div>

            <div class="or-panel-body">
                <div class="or-resumen">
                    <strong>Paciente:</strong> {{ $solicitud->paciente ?? '-' }}<br>
                    <strong>Operación:</strong> {{ $solicitud->operacion ?? '-' }}<br>
                    <strong>Médico:</strong> {{ $solicitud->cirujano_principal ?? '-' }}<br>
                    <strong>Sala:</strong> {{ $solicitud->sala_operacion ?? '-' }}<br>
                    <strong>Fecha/Hora Programada:</strong>
                    {{ $solicitud->fecha_programada ? \Carbon\Carbon::parse($solicitud->fecha_programada)->format('d/m/Y') : '-' }}
                    {{ $solicitud->hora_programada ? \Carbon\Carbon::parse($solicitud->hora_programada)->format('H:i') : '' }}
                </div>

                <form method="POST" action="{{ route('solicitudes.guardarCulminacion', $solicitud->id) }}">
                    @csrf
                    @method('PUT')

                    <div class="or-grid">
                        <div class="field c6">
                            <label>Fecha de Culminación</label>
                            <input class="input" type="date" name="fecha_culminacion"
                                value="{{ old('fecha_culminacion') }}" required>
                        </div>

                        <div class="field c6">
                            <label>Hora de Culminación</label>
                            <input class="input" type="time" name="hora_culminacion"
                                value="{{ old('hora_culminacion') }}" required>
                        </div>

                        <div class="field c12">
                            <label>Observación</label>
                            <textarea class="textarea" name="observacion_culminacion"
                                placeholder="Observaciones finales de la intervención">{{ old('observacion_culminacion') }}</textarea>
                        </div>

                        <div class="c12" style="display:flex; justify-content:flex-end; gap:10px; margin-top:6px;">
                            <a class="or-btn" href="{{ route('solicitudes.index') }}">Cancelar</a>
                            <button type="submit" class="or-btn or-btn-primary">
                                Guardar Culminación
                            </button>
                        </div>
                    </div>
                </form>

            </div>
        </div>

    </div>
</div>
@endsection