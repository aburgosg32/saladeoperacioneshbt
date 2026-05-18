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
        --shadow: 0 12px 32px rgba(35, 64, 70, .12);
        --radius: 18px;
    }

    .sl-page {
        min-height: calc(100vh - 80px);
        padding: 18px 0 22px;
        background:
            radial-gradient(900px 520px at 12% 12%, rgba(53, 200, 159, .18), transparent 58%),
            radial-gradient(900px 520px at 92% 18%, rgba(15, 143, 159, .12), transparent 55%),
            linear-gradient(135deg, var(--bg0), var(--bg1) 48%, #eaf2f0);
        color: var(--text);
        overflow: hidden;
    }

    .sl-container {
        width: min(1500px, 96vw);
        margin: 0 auto;
    }

    .sl-head {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        gap: 14px;
        margin-bottom: 14px;
    }

    .sl-title {
        margin: 0;
        font-size: 28px;
        font-weight: 900;
        color: #172f3a;
    }

    .sl-sub {
        margin: 4px 0 0;
        color: var(--muted);
        font-size: 13px;
    }

    .sl-clock {
        text-align: right;
        padding: 10px 16px;
        border-radius: 18px;
        border: 1px solid rgba(25, 64, 72, .10);
        background: rgba(255, 255, 255, .84);
        box-shadow: var(--shadow);
        min-width: 220px;
    }

    .sl-date {
        font-size: 12px;
        color: var(--muted);
        font-weight: 800;
    }

    .sl-time {
        margin-top: 3px;
        font-size: 28px;
        font-weight: 900;
        color: #172f3a;
        line-height: 1;
    }

    .sl-actions {
        display: flex;
        gap: 8px;
        flex-wrap: wrap;
        margin-bottom: 12px;
    }

    .sl-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 8px 12px;
        border-radius: 14px;
        border: 1px solid rgba(25, 64, 72, .10);
        background: rgba(255, 255, 255, .78);
        color: #253c45;
        text-decoration: none;
        font-size: 12px;
        font-weight: 900;
    }

    .sl-btn-primary {
        border-color: rgba(53, 200, 159, .44);
        background: linear-gradient(135deg, #35c89f, #13a889);
        color: #fff;
    }

    .sl-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 12px;
    }

    .sl-room {
        border: 1px solid var(--line);
        border-radius: var(--radius);
        background:
            radial-gradient(420px 220px at 16% 12%, rgba(53, 200, 159, .09), transparent 58%),
            linear-gradient(180deg, rgba(255, 255, 255, .94), rgba(255, 255, 255, .78));
        box-shadow: var(--shadow);
        overflow: hidden;
        min-height: 235px;
    }

    .sl-room-head {
        padding: 10px 14px;
        border-bottom: 1px solid rgba(25, 64, 72, .10);
        display: flex;
        justify-content: space-between;
        align-items: center;
        background: rgba(255, 255, 255, .58);
    }

    .sl-room-title {
        font-size: 21px;
        font-weight: 900;
        color: #172f3a;
    }

    .sl-status {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 5px 9px;
        border-radius: 999px;
        font-size: 10.5px;
        font-weight: 900;
        border: 1px solid rgba(25, 64, 72, .10);
        background: rgba(255, 255, 255, .75);
        white-space: nowrap;
    }

    .sl-status.ocupada {
        color: #1f8f77;
        border-color: rgba(53, 200, 159, .30);
        background: rgba(53, 200, 159, .12);
    }

    .sl-status.libre {
        color: #6f7f86;
    }

    .sl-dot {
        width: 8px;
        height: 8px;
        border-radius: 999px;
        background: var(--primary);
        box-shadow: 0 0 0 4px rgba(53, 200, 159, .13);
    }

    .sl-dot.off {
        background: #9aa8ad;
        box-shadow: 0 0 0 4px rgba(154, 168, 173, .12);
    }

    .sl-room-body {
        padding: 10px 14px;
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 8px;
    }

    .sl-field {
        border: 1px solid rgba(25, 64, 72, .08);
        border-radius: 13px;
        background: rgba(255, 255, 255, .70);
        padding: 8px 9px;
        min-height: 50px;
    }

    .sl-field.full {
        grid-column: span 2;
    }

    .sl-label {
        display: block;
        font-size: 9.5px;
        font-weight: 900;
        letter-spacing: .35px;
        text-transform: uppercase;
        color: #29414a;
        margin-bottom: 3px;
    }

    .sl-value {
        color: #40545c;
        font-size: 12.5px;
        font-weight: 800;
        line-height: 1.25;
        min-height: 16px;
        word-break: break-word;
    }

    .sl-value.empty {
        color: #9aa8ad;
        font-weight: 700;
    }

    .sl-patient {
        color: #17313b;
        font-size: 15px;
        font-weight: 900;
    }

    .sl-room-footer {
        padding: 0 14px 10px;
    }

    .sl-note {
        border-radius: 13px;
        padding: 7px 10px;
        background: rgba(53, 200, 159, .10);
        border: 1px solid rgba(53, 200, 159, .22);
        color: #227e70;
        font-size: 11px;
        font-weight: 900;
        text-align: center;
    }

    .sl-note.libre {
        background: rgba(111, 127, 134, .08);
        border-color: rgba(25, 64, 72, .10);
        color: #6f7f86;
    }

    @media (max-width: 1200px) {
        .sl-grid {
            grid-template-columns: repeat(2, 1fr);
        }

        .sl-page {
            overflow: auto;
        }
    }

    @media (max-width: 800px) {
        .sl-grid {
            grid-template-columns: 1fr;
        }

        .sl-head {
            flex-direction: column;
        }

        .sl-clock {
            text-align: left;
        }

        .sl-page {
            overflow: auto;
        }
    }
</style>

<div class="sl-page">
    <div class="sl-container">

        <div class="sl-head">
            <div>
                <h1 class="sl-title">Monitor de Salas de Operaciones</h1>
                <p class="sl-sub">
                    Visualización compacta de las 6 salas. Muestra cirugía en curso, paciente, operación, cirujano, servicio, tipo y hora de inicio.
                </p>
            </div>

            <div class="sl-clock">
                <div class="sl-date" id="slDate"></div>
                <div class="sl-time" id="slTime"></div>
            </div>
        </div>

        <div class="sl-grid">
            @foreach($salasBase as $sala)
            @php
            $c = $cirugiasEnSala->get($sala);
            $ocupada = !is_null($c);
            @endphp

            <div class="sl-room {{ $ocupada ? 'ocupada' : 'libre' }}">
                <div class="sl-room-head">
                    <div class="sl-room-title">{{ $sala }}</div>

                    @if($ocupada)
                    <div class="sl-status ocupada">
                        <span class="sl-dot"></span> EN USO
                    </div>
                    @else
                    <div class="sl-status libre">
                        <span class="sl-dot off"></span> DISPONIBLE
                    </div>
                    @endif
                </div>

                <div class="sl-room-body">
                    <div class="sl-field full">
                        <span class="sl-label">Paciente</span>
                        <div class="sl-value sl-patient {{ $ocupada ? '' : 'empty' }}">
                            {{ $c->paciente ?? '-' }}
                        </div>
                    </div>

                    <div class="sl-field full">
                        <span class="sl-label">Operación</span>
                        <div class="sl-value {{ $ocupada ? '' : 'empty' }}">
                            {{ $c->operacion ?? '-' }}
                        </div>
                    </div>

                    <div class="sl-field">
                        <span class="sl-label">Cirujano</span>
                        <div class="sl-value {{ $ocupada ? '' : 'empty' }}">
                            {{ $c->cirujano_principal ?? '-' }}
                        </div>
                    </div>

                    <div class="sl-field">
                        <span class="sl-label">Servicio</span>
                        <div class="sl-value {{ $ocupada ? '' : 'empty' }}">
                            {{ $c->servicio ?? '-' }}
                        </div>
                    </div>

                    <div class="sl-field">
                        <span class="sl-label">Tipo</span>
                        <div class="sl-value {{ $ocupada ? '' : 'empty' }}">
                            {{ $c->tipo_solicitud ?? '-' }}
                        </div>
                    </div>

                    <div class="sl-field">
                        <span class="sl-label">Hora inicio</span>
                        <div class="sl-value {{ $ocupada ? '' : 'empty' }}">
                            @if($c && $c->hora_inicio)
                            {{ \Carbon\Carbon::parse($c->hora_inicio)->format('H:i') }}
                            @else
                            -
                            @endif
                        </div>
                    </div>
                </div>

                <div class="sl-room-footer">
                    @if($ocupada)
                    <div class="sl-note">
                        Cirugía actualmente en ejecución
                    </div>
                    @else
                    <div class="sl-note libre">
                        Sala sin cirugía en curso
                    </div>
                    @endif
                </div>
            </div>
            @endforeach
        </div>

    </div>
</div>

<script>
    function actualizarRelojSalas() {
        const ahora = new Date();

        document.getElementById('slDate').textContent = ahora.toLocaleDateString('es-PE', {
            weekday: 'long',
            year: 'numeric',
            month: 'long',
            day: 'numeric'
        });

        document.getElementById('slTime').textContent = ahora.toLocaleTimeString('es-PE', {
            hour: '2-digit',
            minute: '2-digit',
            second: '2-digit'
        });
    }

    actualizarRelojSalas();
    setInterval(actualizarRelojSalas, 1000);

    setTimeout(function() {
        location.reload();
    }, 30000);
</script>
@endsection