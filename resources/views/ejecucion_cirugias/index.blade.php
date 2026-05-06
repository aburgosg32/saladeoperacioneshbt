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
        --danger: #ff6b6b;
        --violet: #9b7bff;
        --shadow: 0 18px 60px rgba(0, 0, 0, .45);
        --radius: 18px;
    }

    .qx-page {
        min-height: calc(100vh - 80px);
        padding: 24px 0 36px;
        background:
            radial-gradient(1100px 650px at 12% 10%, rgba(43, 212, 197, .10), transparent 60%),
            radial-gradient(900px 520px at 90% 15%, rgba(27, 179, 242, .10), transparent 55%),
            linear-gradient(180deg, var(--bg0), var(--bg1));
        color: var(--text);
    }

    .qx-container {
        width: min(1280px, 96vw);
        margin: 0 auto;
    }

    .qx-head {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        gap: 12px;
        flex-wrap: wrap;
        margin-bottom: 16px;
    }

    .qx-title {
        margin: 0;
        font-size: 28px;
        font-weight: 900;
    }

    .qx-sub {
        margin: 6px 0 0;
        color: var(--muted);
        font-size: 13px;
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
        border-radius: 14px;
        border: 1px solid var(--line);
        background: rgba(12, 40, 56, .35);
        color: var(--text);
        text-decoration: none;
        font-size: 12.5px;
        font-weight: 800;
    }

    .qx-btn:hover {
        border-color: rgba(27, 179, 242, .45);
        background: rgba(12, 40, 56, .55);
        color: var(--text);
        text-decoration: none;
    }

    .qx-btn-primary {
        border-color: rgba(43, 212, 197, .60);
        background: linear-gradient(135deg, rgba(43, 212, 197, .18), rgba(27, 179, 242, .14));
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
        border-radius: 18px;
        background:
            radial-gradient(700px 240px at 18% 20%, rgba(43, 212, 197, .10), transparent 55%),
            linear-gradient(180deg, rgba(12, 40, 56, .78), rgba(12, 40, 56, .40));
        box-shadow: var(--shadow);
        padding: 16px;
    }

    .qx-card-label {
        color: var(--muted);
        font-size: 12px;
        font-weight: 800;
        margin-bottom: 8px;
        text-transform: uppercase;
        letter-spacing: .5px;
    }

    .qx-card-value {
        font-size: 30px;
        font-weight: 900;
        line-height: 1;
    }

    .qx-card-note {
        margin-top: 8px;
        font-size: 12px;
        color: var(--muted);
    }

    .qx-alert {
        margin-bottom: 14px;
        padding: 12px 14px;
        border-radius: 14px;
        font-size: 13px;
        font-weight: 700;
    }

    .qx-alert-ok {
        border: 1px solid rgba(43, 212, 197, .35);
        background: rgba(43, 212, 197, .08);
        color: rgba(234, 243, 248, .95);
    }

    .qx-alert-error {
        border: 1px solid rgba(255, 107, 107, .35);
        background: rgba(255, 107, 107, .08);
        color: rgba(255, 255, 255, .95);
    }

    .qx-panel {
        border: 1px solid var(--line);
        border-radius: 18px;
        background:
            radial-gradient(900px 420px at 18% 20%, rgba(43, 212, 197, .10), transparent 55%),
            radial-gradient(700px 420px at 85% 30%, rgba(27, 179, 242, .08), transparent 55%),
            linear-gradient(180deg, rgba(12, 40, 56, .78), rgba(12, 40, 56, .40));
        box-shadow: var(--shadow);
        overflow: hidden;
    }

    .qx-panel-head {
        padding: 14px 16px;
        border-bottom: 1px solid var(--line);
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 12px;
        flex-wrap: wrap;
    }

    .qx-panel-title {
        font-weight: 900;
        font-size: 14px;
    }

    .qx-filter {
        display: flex;
        gap: 10px;
        align-items: center;
        flex-wrap: wrap;
    }

    .qx-input {
        height: 40px;
        border-radius: 12px;
        border: 1px solid rgba(255, 255, 255, .12);
        background: rgba(255, 255, 255, .04);
        color: var(--text);
        padding: 0 12px;
        outline: none;
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
        border-bottom: 1px solid rgba(255, 255, 255, .08);
        font-size: 12.5px;
        vertical-align: middle;
    }

    .qx-table th {
        color: rgba(234, 243, 248, .85);
        font-weight: 900;
        font-size: 12px;
        text-transform: uppercase;
        letter-spacing: .45px;
        background: rgba(12, 40, 56, .22);
    }

    .qx-badge {
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

    .qx-state-p {
        background: rgba(43, 212, 197, .12);
        color: #2bd4c5;
        border-color: rgba(43, 212, 197, .28);
    }

    .qx-state-e {
        background: rgba(155, 123, 255, .12);
        color: #c7b5ff;
        border-color: rgba(155, 123, 255, .30);
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
        border: 1px solid rgba(255, 255, 255, .12);
        border-radius: 10px;
        background: rgba(12, 40, 56, .35);
        color: var(--text);
        font-size: 12px;
        font-weight: 800;
        cursor: pointer;
    }

    .qx-btn-start {
        border-color: rgba(155, 123, 255, .30);
        background: rgba(155, 123, 255, .12);
        color: #d4c8ff;
    }

    .qx-btn-finish {
        border-color: rgba(27, 179, 242, .30);
        background: rgba(27, 179, 242, .12);
        color: #8eddff;
    }

    .qx-btn-sm:hover {
        opacity: .92;
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
                <a class="qx-btn" href="{{ url('/home') }}">Dashboard</a>
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
@endsection