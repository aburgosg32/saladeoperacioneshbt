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
        --danger: #d64d4d;
        --warning: #c8952d;
        --violet: #7c68c9;
        --shadow: 0 22px 60px rgba(35, 64, 70, .14);
        --shadow2: 0 10px 30px rgba(35, 64, 70, .10);
        --radius: 22px;
    }

    .qx-page {
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

    .qx-page::before {
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

    .qx-container {
        width: min(1280px, 96vw);
        margin: 0 auto;
        position: relative;
        z-index: 1;
    }

    .qx-head {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        gap: 16px;
        flex-wrap: wrap;
        margin-bottom: 18px;
    }

    .qx-title {
        margin: 0;
        font-size: 28px;
        font-weight: 900;
        color: #172f3a;
        letter-spacing: -.4px;
    }

    .qx-sub {
        margin: 6px 0 0;
        color: var(--muted);
        font-size: 13.5px;
        line-height: 1.7;
    }

    .qx-actions {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
    }

    .qx-btn {
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

    .qx-btn:hover {
        transform: translateY(-1px);
        background: #ffffff;
        border-color: rgba(53, 200, 159, .30);
        box-shadow: 0 10px 26px rgba(35, 64, 70, .10);
        color: #253c45;
        text-decoration: none;
    }

    .qx-btn-primary {
        border-color: rgba(53, 200, 159, .44);
        background: linear-gradient(135deg, #35c89f, #13a889);
        color: #ffffff;
        box-shadow: 0 12px 26px rgba(53, 200, 159, .20);
    }

    .qx-btn-primary:hover {
        background: linear-gradient(135deg, #39d6aa, #0f9f83);
        color: #ffffff;
    }

    .qx-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 14px;
        margin-bottom: 18px;
    }

    @media (max-width: 1100px) {
        .qx-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 700px) {
        .qx-grid {
            grid-template-columns: 1fr;
        }
    }

    .qx-card {
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

    .qx-card::after {
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

    .qx-card-label {
        color: var(--muted);
        font-size: 12px;
        font-weight: 900;
        margin-bottom: 8px;
        text-transform: uppercase;
        letter-spacing: .5px;
        position: relative;
        z-index: 1;
    }

    .qx-card-value {
        font-size: 30px;
        font-weight: 900;
        line-height: 1;
        color: #172f3a;
        position: relative;
        z-index: 1;
    }

    .qx-card-note {
        margin-top: 8px;
        font-size: 12px;
        color: var(--muted);
        font-weight: 700;
        position: relative;
        z-index: 1;
    }

    .qx-alert {
        margin-bottom: 14px;
        padding: 12px 14px;
        border-radius: 16px;
        font-size: 13px;
        font-weight: 800;
        box-shadow: var(--shadow2);
    }

    .qx-alert-ok {
        border: 1px solid rgba(53, 200, 159, .30);
        background: rgba(53, 200, 159, .10);
        color: #227e70;
    }

    .qx-alert-error {
        border: 1px solid rgba(214, 77, 77, .30);
        background: rgba(214, 77, 77, .10);
        color: #b43d3d;
    }

    .qx-panel {
        border: 1px solid var(--line);
        border-radius: var(--radius);
        background:
            radial-gradient(500px 260px at 16% 12%, rgba(53, 200, 159, .08), transparent 58%),
            linear-gradient(180deg, rgba(255, 255, 255, .94), rgba(255, 255, 255, .76));
        box-shadow: var(--shadow);
        overflow: hidden;
        backdrop-filter: blur(14px);
    }

    .qx-panel-head {
        padding: 14px 16px;
        border-bottom: 1px solid rgba(25, 64, 72, .10);
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 12px;
        flex-wrap: wrap;
        background: rgba(255, 255, 255, .52);
    }

    .qx-panel-title {
        font-weight: 900;
        font-size: 14px;
        color: #17313b;
    }

    .qx-filter {
        display: flex;
        gap: 10px;
        align-items: center;
        flex-wrap: wrap;
    }

    .qx-input {
        height: 40px;
        border-radius: 14px;
        border: 1px solid rgba(25, 64, 72, .10);
        background: rgba(255, 255, 255, .88);
        color: #20313a;
        padding: 0 12px;
        outline: none;
        font-size: 13px;
        font-weight: 700;
        transition: .15s ease;
    }

    .qx-input:focus {
        border-color: rgba(53, 200, 159, .55);
        background: #ffffff;
        box-shadow: 0 0 0 4px rgba(53, 200, 159, .10);
    }

    .qx-table-wrap {
        padding: 0 8px 12px;
        overflow-x: auto;
    }

    .qx-table {
        width: 100%;
        border-collapse: collapse;
        min-width: 980px;
    }

    .qx-table th,
    .qx-table td {
        padding: 12px 10px;
        border-bottom: 1px solid rgba(25, 64, 72, .08);
        font-size: 12.5px;
        vertical-align: middle;
    }

    .qx-table th {
        color: #29414a;
        font-weight: 900;
        font-size: 12px;
        text-transform: uppercase;
        letter-spacing: .45px;
        background: rgba(255, 255, 255, .66);
    }

    .qx-table td {
        color: #40545c;
    }

    .qx-table tbody tr:hover td {
        background: rgba(53, 200, 159, .045);
    }

    .qx-badge {
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

    .qx-state-p {
        background: rgba(53, 200, 159, .12);
        color: #1f8f77;
        border-color: rgba(53, 200, 159, .30);
    }

    .qx-state-e {
        background: rgba(124, 104, 201, .12);
        color: #6753b0;
        border-color: rgba(124, 104, 201, .24);
    }

    .qx-row-actions {
        display: flex;
        align-items: center;
        gap: 8px;
        flex-wrap: wrap;
    }

    .qx-form-inline {
        display: inline-flex;
        margin: 0;
    }

    .qx-btn-sm {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 90px;
        height: 34px;
        padding: 0 12px;
        border: 1px solid rgba(25, 64, 72, .10);
        border-radius: 13px;
        background: rgba(255, 255, 255, .78);
        color: #253c45;
        font-size: 12px;
        font-weight: 900;
        cursor: pointer;
        transition: .15s ease;
    }

    .qx-btn-start {
        border-color: rgba(124, 104, 201, .24);
        background: rgba(124, 104, 201, .12);
        color: #6753b0;
    }

    .qx-btn-finish {
        border-color: rgba(15, 143, 159, .24);
        background: rgba(15, 143, 159, .12);
        color: #0b7f8e;
    }

    .qx-btn-sm:hover {
        transform: translateY(-1px);
        background: #ffffff;
        box-shadow: 0 10px 20px rgba(35, 64, 70, .10);
    }

    .qx-pagination {
        padding: 16px;
        display: flex;
        justify-content: center;
    }

    .qx-empty {
        padding: 20px 12px;
        text-align: center;
        color: var(--muted);
    }
</style>

<div class="qx-page">
    <div class="qx-container">

        <div class="qx-head">
            <div>
                <h1 class="qx-title">Ejecución de Cirugías</h1>
                <p class="qx-sub">Control operativo para iniciar y culminar cirugías programadas.</p>
            </div>

            <div class="qx-actions">
                <a class="qx-btn" href="{{ route('home') }}">Menu Principal</a>
                <a class="qx-btn" href="{{ route('solicitudes.index') }}">Solicitudes</a>
            </div>
        </div>

        @if(session('ok'))
        <div class="qx-alert qx-alert-ok">{{ session('ok') }}</div>
        @endif

        @if(session('error'))
        <div class="qx-alert qx-alert-error">{{ session('error') }}</div>
        @endif

        <div class="qx-grid">
            <div class="qx-card">
                <div class="qx-card-label">Fecha de trabajo</div>
                <div class="qx-card-value" style="font-size:22px;">
                    {{ \Carbon\Carbon::parse($fecha)->format('d/m/Y') }}
                </div>
                <div class="qx-card-note">Filtro actual de ejecución</div>
            </div>

            <div class="qx-card">
                <div class="qx-card-label">Programadas</div>
                <div class="qx-card-value">{{ $totalProgramadas }}</div>
                <div class="qx-card-note">Pendientes de iniciar</div>
            </div>

            <div class="qx-card">
                <div class="qx-card-label">En curso</div>
                <div class="qx-card-value">{{ $totalEnCurso }}</div>
                <div class="qx-card-note">Operaciones activas</div>
            </div>

            <div class="qx-card">
                <div class="qx-card-label">Culminadas</div>
                <div class="qx-card-value">{{ $totalCulminadas }}</div>
                <div class="qx-card-note">Finalizadas en la fecha</div>
            </div>
        </div>

        <div class="qx-panel">
            <div class="qx-panel-head">
                <div class="qx-panel-title">Listado operativo</div>

                <form method="GET" action="{{ route('ejecucion-cirugias.index') }}" class="qx-filter">
                    <input type="date" name="fecha" value="{{ $fecha }}" class="qx-input">
                    <button type="submit" class="qx-btn qx-btn-primary">Filtrar</button>
                </form>
            </div>

            <div class="qx-table-wrap">
                <table class="qx-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Hora</th>
                            <th>Sala</th>
                            <th>Paciente</th>
                            <th>Operación</th>
                            <th>Cirujano</th>
                            <th>Tipo</th>
                            <th>Estado</th>
                            <th style="text-align:center;">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($cirugias as $c)
                        <tr>
                            <td>{{ $c->id }}</td>
                            <td>
                                {{ $c->hora_programada ? \Carbon\Carbon::parse($c->hora_programada)->format('H:i') : '-' }}
                            </td>
                            <td>{{ $c->sala_operacion ?? '-' }}</td>
                            <td>{{ $c->paciente ?? '-' }}</td>
                            <td>{{ $c->operacion ?? '-' }}</td>
                            <td>{{ $c->cirujano_principal ?? '-' }}</td>
                            <td>{{ $c->tipo_solicitud ?? '-' }}</td>
                            <td>
                                @if($c->estado === 'P')
                                <span class="qx-badge qx-state-p">Programado</span>
                                @elseif($c->estado === 'E')
                                <span class="qx-badge qx-state-e">En curso</span>
                                @endif
                            </td>
                            <td style="text-align:center;">
                                <div class="qx-row-actions" style="justify-content:center;">
                                    @can('ejecucion.iniciar')
                                    @if($c->estado === 'P')
                                    <form action="{{ route('ejecucion-cirugias.iniciar', $c->id) }}" method="POST" class="qx-form-inline" onsubmit="return confirm('¿Iniciar la operación #{{ $c->id }}?')">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="qx-btn-sm qx-btn-start">Iniciar</button>
                                    </form>
                                    @endif
                                    @endcan

                                    @can('ejecucion.culminar')
                                    @if($c->estado === 'E')
                                    <form action="{{ route('ejecucion-cirugias.culminar', $c->id) }}" method="POST" class="qx-form-inline" onsubmit="return confirm('¿Culminar la operación #{{ $c->id }}?')">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="qx-btn-sm qx-btn-finish">Culminar</button>
                                    </form>
                                    @endif
                                    @endcan
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="9" class="qx-empty">No hay operaciones programadas o en curso para la fecha seleccionada.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if(method_exists($cirugias, 'links'))
            <div class="qx-pagination">
                {{ $cirugias->appends(['fecha' => $fecha])->links() }}
            </div>
            @endif
        </div>
    </div>
</div>

<script>
    setTimeout(function() {
        location.reload();
    }, 30000);
</script>
@endsection