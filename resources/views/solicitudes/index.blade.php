@extends('layouts.app')

@section('content')
<style>
    :root {
        --bg0: #eef4f2;
        --bg1: #f8fbfa;
        --panel: rgba(255, 255, 255, .88);
        --panel2: rgba(255, 255, 255, .72);
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
        width: min(1280px, 96vw);
        margin: 0 auto;
        position: relative;
        z-index: 1;
    }

    .or-head {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 16px;
        flex-wrap: wrap;
        margin-bottom: 18px;
    }

    .or-title {
        margin: 0;
        font-size: 26px;
        font-weight: 900;
        letter-spacing: -.4px;
        color: #172f3a;
    }

    .or-sub {
        margin: 6px 0 0;
        color: var(--muted);
        font-size: 13.5px;
        line-height: 1.7;
        max-width: 82ch;
    }

    .or-actions {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
        align-items: center;
    }

    .or-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        padding: 10px 14px;
        border-radius: 15px;
        border: 1px solid rgba(25, 64, 72, .10);
        background: rgba(255, 255, 255, .78);
        color: #253c45;
        text-decoration: none;
        font-size: 12.5px;
        font-weight: 900;
        transition: transform .15s ease, border-color .15s ease, background .15s ease, box-shadow .15s ease;
        white-space: nowrap;
        cursor: pointer;
    }

    .or-btn:hover {
        transform: translateY(-1px);
        background: #ffffff;
        border-color: rgba(53, 200, 159, .30);
        box-shadow: 0 10px 26px rgba(35, 64, 70, .10);
        color: #253c45;
    }

    .or-btn-primary {
        border-color: rgba(53, 200, 159, .44);
        background: linear-gradient(135deg, #35c89f, #13a889);
        color: #ffffff;
        box-shadow: 0 12px 26px rgba(53, 200, 159, .20);
    }

    .or-btn-primary:hover {
        border-color: rgba(19, 168, 137, .70);
        background: linear-gradient(135deg, #39d6aa, #0f9f83);
        color: #ffffff;
    }

    .or-alert {
        margin-bottom: 14px;
        border: 1px solid rgba(53, 200, 159, .30);
        background: rgba(53, 200, 159, .10);
        color: #227e70;
        padding: 12px 14px;
        border-radius: 16px;
        font-size: 12.5px;
        font-weight: 800;
        box-shadow: var(--shadow2);
    }

    .or-filter-panel {
        border: 1px solid var(--line);
        border-radius: var(--radius);
        background:
            radial-gradient(500px 260px at 16% 12%, rgba(53, 200, 159, .08), transparent 58%),
            linear-gradient(180deg, rgba(255, 255, 255, .94), rgba(255, 255, 255, .76));
        box-shadow: var(--shadow2);
        padding: 16px;
        margin-bottom: 16px;
    }

    .or-filter-grid {
        display: grid;
        grid-template-columns: repeat(12, 1fr);
        gap: 12px;
        align-items: end;
    }

    .or-filter-field {
        display: flex;
        flex-direction: column;
        gap: 6px;
    }

    .or-filter-field label {
        color: #29414a;
        font-size: 11px;
        font-weight: 900;
        text-transform: uppercase;
        letter-spacing: .4px;
    }

    .or-filter-input,
    .or-filter-select {
        width: 100%;
        border-radius: 15px;
        border: 1px solid rgba(25, 64, 72, .10);
        background: rgba(255, 255, 255, .88);
        color: #20313a;
        padding: 10px 12px;
        outline: none;
        font-size: 13px;
        font-weight: 700;
        transition: .15s ease;
    }

    .or-filter-input:focus,
    .or-filter-select:focus {
        border-color: rgba(53, 200, 159, .55);
        background: #ffffff;
        box-shadow: 0 0 0 4px rgba(53, 200, 159, .10);
    }

    .or-filter-select option {
        background: #ffffff;
        color: #20313a;
    }

    .or-filter-c2 {
        grid-column: span 2;
    }

    .or-filter-c4 {
        grid-column: span 4;
    }

    .or-filter-actions {
        grid-column: span 3;
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
    }

    @media (max-width: 980px) {

        .or-filter-c2,
        .or-filter-c4,
        .or-filter-actions {
            grid-column: span 12;
        }
    }

    .or-panel {
        border: 1px solid var(--line);
        border-radius: var(--radius);
        background:
            radial-gradient(500px 260px at 16% 12%, rgba(53, 200, 159, .08), transparent 58%),
            linear-gradient(180deg, rgba(255, 255, 255, .94), rgba(255, 255, 255, .76));
        box-shadow: var(--shadow);
        overflow: hidden;
        backdrop-filter: blur(14px);
    }

    .or-panel-head {
        padding: 14px 16px;
        border-bottom: 1px solid rgba(25, 64, 72, .10);
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        flex-wrap: wrap;
        background: rgba(255, 255, 255, .52);
    }

    .or-panel-head .label {
        font-weight: 900;
        font-size: 13px;
        letter-spacing: .2px;
        color: #17313b;
    }

    .or-count {
        color: #227e70;
        font-size: 12px;
        font-weight: 900;
        border: 1px solid rgba(53, 200, 159, .24);
        padding: 6px 10px;
        border-radius: 999px;
        background: rgba(53, 200, 159, .10);
    }

    .or-table-wrap {
        padding: 0 8px 12px;
        overflow-x: auto;
    }

    table.or-table {
        width: 100%;
        border-collapse: collapse;
        min-width: 1220px;
    }

    .or-table th,
    .or-table td {
        padding: 14px 10px;
        border-bottom: 1px solid rgba(25, 64, 72, .08);
        font-size: 12.5px;
        vertical-align: middle;
    }

    .or-table th {
        color: #29414a;
        font-weight: 900;
        font-size: 12px;
        text-transform: uppercase;
        letter-spacing: .5px;
        background: rgba(255, 255, 255, .66);
    }

    .or-table td {
        color: #40545c;
    }

    .or-table tbody tr:hover td {
        background: rgba(53, 200, 159, .045);
    }

    .or-muted {
        color: var(--muted);
    }

    .or-badge {
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

    .or-dot {
        width: 8px;
        height: 8px;
        border-radius: 999px;
        background: var(--primary);
        box-shadow: 0 0 0 4px rgba(53, 200, 159, .12);
    }

    .or-dot.red {
        background: var(--danger);
        box-shadow: 0 0 0 4px rgba(214, 77, 77, .12);
    }

    .or-state-badge {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 5px 10px;
        border-radius: 999px;
        font-size: 11px;
        font-weight: 900;
        letter-spacing: .2px;
        border: 1px solid rgba(25, 64, 72, .10);
        white-space: nowrap;
    }

    .or-state-s {
        background: rgba(200, 149, 45, .12);
        color: #9b6d13;
        border-color: rgba(200, 149, 45, .22);
    }

    .or-state-a {
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

    .or-actions-row {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 10px;
    }

    .or-inline-form {
        margin: 0;
        padding: 0;
        display: inline-flex;
    }

    .or-icon-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 36px;
        height: 36px;
        border-radius: 13px;
        border: 1px solid rgba(25, 64, 72, .10);
        background: rgba(255, 255, 255, .78);
        color: #253c45;
        text-decoration: none;
        font-size: 15px;
        transition: transform .15s ease, border-color .15s ease, background .15s ease, box-shadow .15s ease;
    }

    .or-icon-btn:hover {
        transform: translateY(-1px);
        background: #ffffff;
        border-color: rgba(53, 200, 159, .30);
        box-shadow: 0 10px 20px rgba(35, 64, 70, .10);
        color: #253c45;
    }

    .or-icon-btn-danger {
        cursor: pointer;
    }

    .or-icon-btn-danger:hover {
        border-color: rgba(214, 77, 77, .35);
    }

    .or-paciente {
        max-width: 170px;
        line-height: 1.35;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        text-overflow: ellipsis;
        word-break: break-word;
        color: #20313a;
        font-weight: 800;
    }

    .or-operacion {
        max-width: 280px;
        white-space: normal;
        line-height: 1.5;
        word-break: break-word;
    }

    .or-servicio {
        max-width: 130px;
        line-height: 1.5;
    }

    .or-medico {
        max-width: 150px;
        white-space: normal;
        line-height: 1.5;
        word-break: break-word;
    }

    .or-fecha {
        font-weight: 900;
        line-height: 1.3;
        color: #20313a;
    }

    .or-hora {
        font-size: 11px;
        color: var(--muted);
        line-height: 1.3;
        margin-top: 2px;
    }

    .or-sala {
        white-space: nowrap;
        font-weight: 800;
    }

    .or-pagination-wrap {
        padding: 16px;
        display: flex;
        justify-content: center;
        overflow-x: auto;
    }

    .or-pagination-wrap nav {
        width: auto;
    }

    .or-pagination-wrap svg {
        width: 16px !important;
        height: 16px !important;
        max-width: 16px !important;
        max-height: 16px !important;
        vertical-align: middle;
    }

    .or-pagination-wrap .hidden.sm\:flex-1,
    .or-pagination-wrap .sm\:hidden {
        display: none !important;
    }

    .or-pagination-wrap .sm\:flex {
        display: flex !important;
        align-items: center;
        justify-content: center;
        gap: 8px;
        flex-wrap: wrap;
    }

    .or-pagination-wrap [aria-label="Pagination Navigation"]>div:first-child {
        display: none !important;
    }

    .or-pagination-wrap [aria-label="Pagination Navigation"]>div:last-child {
        display: flex !important;
        justify-content: center;
        align-items: center;
        gap: 8px;
        flex-wrap: wrap;
    }

    .or-pagination-wrap a,
    .or-pagination-wrap span[aria-current="page"] span,
    .or-pagination-wrap span[aria-disabled="true"] span {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 40px;
        height: 40px;
        padding: 0 14px;
        border-radius: 13px;
        border: 1px solid rgba(25, 64, 72, .10);
        background: rgba(255, 255, 255, .78);
        color: #253c45 !important;
        text-decoration: none !important;
        font-size: 12.5px;
        font-weight: 900;
        line-height: 1;
        box-shadow: none !important;
    }

    .or-pagination-wrap a:hover {
        border-color: rgba(53, 200, 159, .30);
        background: #ffffff;
        color: #253c45 !important;
    }

    .or-pagination-wrap span[aria-current="page"] span {
        background: linear-gradient(135deg, #35c89f, #13a889);
        border-color: rgba(53, 200, 159, .44);
        color: #ffffff !important;
    }

    .or-pagination-wrap span[aria-disabled="true"] span {
        opacity: .45;
        cursor: not-allowed;
    }
</style>

<div class="or-page">
    <div class="or-container">

        <div class="or-head">
            <div>
                <h1 class="or-title">Solicitudes de Sala de Operaciones</h1>
                <p class="or-sub">
                    Gestiona el registro de solicitudes programadas o emergencias. Puedes filtrar por fecha, paciente, médico, servicio, operación, estado o tipo de solicitud.
                </p>
            </div>

            <div class="or-actions">
                <a class="or-btn" href="{{ route('home') }}">Menu Principal</a>

                @can('solicitudes.crear')
                <a class="or-btn or-btn-primary" href="{{ route('solicitudes.create') }}">
                    Nueva Solicitud
                </a>
                @endcan
            </div>
        </div>

        @if(session('ok'))
        <div class="or-alert">{{ session('ok') }}</div>
        @endif

        <div class="or-filter-panel">
            <form method="GET" action="{{ route('solicitudes.index') }}">
                <div class="or-filter-grid">

                    <div class="or-filter-field or-filter-c2">
                        <label>Fecha inicio</label>
                        <input
                            type="date"
                            name="fecha_inicio"
                            value="{{ request('fecha_inicio') }}"
                            class="or-filter-input">
                    </div>

                    <div class="or-filter-field or-filter-c2">
                        <label>Fecha fin</label>
                        <input
                            type="date"
                            name="fecha_fin"
                            value="{{ request('fecha_fin') }}"
                            class="or-filter-input">
                    </div>

                    <div class="or-filter-field or-filter-c2">
                        <label>Estado</label>
                        <select name="estado" class="or-filter-select">
                            <option value="">Todos</option>
                            <option value="S" {{ request('estado') === 'S' ? 'selected' : '' }}>Solicitado</option>
                            <option value="P" {{ request('estado') === 'P' ? 'selected' : '' }}>Programado</option>
                            <option value="E" {{ request('estado') === 'E' ? 'selected' : '' }}>En curso</option>
                            <option value="C" {{ request('estado') === 'C' ? 'selected' : '' }}>Culminado</option>
                        </select>
                    </div>

                    <div class="or-filter-field or-filter-c2">
                        <label>Tipo</label>
                        <select name="tipo_solicitud" class="or-filter-select">
                            <option value="">Todos</option>
                            <option value="PROGRAMADA" {{ request('tipo_solicitud') === 'PROGRAMADA' ? 'selected' : '' }}>Programada</option>
                            <option value="EMERGENCIA" {{ request('tipo_solicitud') === 'EMERGENCIA' ? 'selected' : '' }}>Emergencia</option>
                        </select>
                    </div>

                    <div class="or-filter-field or-filter-c4">
                        <label>Buscar</label>
                        <input
                            type="text"
                            name="buscar"
                            value="{{ request('buscar') }}"
                            class="or-filter-input"
                            placeholder="Paciente, médico, servicio, operación o historia clínica">
                    </div>

                    <div class="or-filter-actions">
                        <button type="submit" class="or-btn or-btn-primary">
                            Filtrar
                        </button>

                        <a href="{{ route('solicitudes.index') }}" class="or-btn">
                            Limpiar
                        </a>
                    </div>

                </div>
            </form>
        </div>

        <div class="or-panel">
            <div class="or-panel-head">
                <div class="label">Listado</div>
                <div class="or-count">
                    Total: {{ method_exists($solicitudes, 'total') ? $solicitudes->total() : count($solicitudes) }}
                </div>
            </div>

            <div class="or-table-wrap">
                <table class="or-table">
                    <thead>
                        <tr>
                            <th style="width:60px;" class="text-center">#</th>
                            <th style="width:110px;" class="text-center">Tipo</th>
                            <th style="width:100px;" class="text-center">Estado</th>
                            <th style="width:145px;" class="text-center">Fec/Hora Solic.</th>
                            <th style="width:145px;" class="text-center">Fec/Hora Prog.</th>
                            <th style="width:90px;" class="text-center">Sala</th>
                            <th style="width:190px;">Paciente</th>
                            <th style="width:280px;">Operación</th>
                            <th style="width:130px;">Servicio</th>
                            <th style="width:150px;" class="text-center">Médico</th>
                            <th style="width:150px; text-align:center;">Acciones</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($solicitudes as $s)
                        <tr>
                            <td class="text-center or-muted">{{ $s->id }}</td>

                            <td class="text-center">
                                @if($s->tipo_solicitud === 'EMERGENCIA')
                                <span class="or-badge">
                                    <span class="or-dot red"></span> EMERG.
                                </span>
                                @else
                                <span class="or-badge">
                                    <span class="or-dot"></span> PROG.
                                </span>
                                @endif
                            </td>

                            <td class="text-center">
                                @if($s->estado === 'P')
                                <span class="or-state-badge or-state-a">Programado</span>
                                @elseif($s->estado === 'E')
                                <span class="or-state-badge or-state-e">En curso</span>
                                @elseif($s->estado === 'C')
                                <span class="or-state-badge or-state-c">Culminado</span>
                                @else
                                <span class="or-state-badge or-state-s">Solicitado</span>
                                @endif
                            </td>

                            <td class="text-center or-muted">
                                @if($s->para_el_dia || $s->a_horas)
                                <div class="or-fecha">
                                    {{ $s->para_el_dia ? \Carbon\Carbon::parse($s->para_el_dia)->format('d/m/Y') : '-' }}
                                </div>
                                <div class="or-hora">
                                    {{ $s->a_horas ? \Carbon\Carbon::parse($s->a_horas)->format('H:i') : '-' }}
                                </div>
                                @else
                                <div class="or-fecha">-</div>
                                <div class="or-hora">-</div>
                                @endif
                            </td>

                            <td class="text-center or-muted">
                                @if($s->fecha_programada || $s->hora_programada)
                                <div class="or-fecha">
                                    {{ $s->fecha_programada ? \Carbon\Carbon::parse($s->fecha_programada)->format('d/m/Y') : '-' }}
                                </div>
                                <div class="or-hora">
                                    {{ $s->hora_programada ? \Carbon\Carbon::parse($s->hora_programada)->format('H:i') : '-' }}
                                </div>
                                @else
                                <div class="or-fecha">-</div>
                                <div class="or-hora">-</div>
                                @endif
                            </td>

                            <td class="text-center or-muted or-sala">
                                {{ $s->sala_operacion ?? '-' }}
                            </td>

                            <td class="or-paciente" title="{{ $s->paciente }}">
                                {{ $s->paciente }}
                            </td>

                            <td class="or-operacion" title="{{ $s->operacion }}">
                                {{ $s->operacion }}
                            </td>

                            <td class="or-servicio or-muted">
                                {{ $s->servicio }}
                            </td>

                            <td class="or-medico or-muted" title="{{ $s->cirujano_principal }}">
                                {{ $s->cirujano_principal }}
                            </td>

                            <td>
                                <div class="or-actions-row">
                                    <a class="or-icon-btn"
                                        href="{{ route('solicitudes.show', $s) }}"
                                        title="Ver">
                                        👁
                                    </a>

                                    @can('solicitudes.editar')
                                    <a class="or-icon-btn"
                                        href="{{ route('solicitudes.edit', $s) }}"
                                        title="Editar">
                                        ✏️
                                    </a>
                                    @endcan

                                    @can('ejecucion.culminar')
                                    @if($s->estado === 'P')
                                    <a class="or-icon-btn"
                                        href="{{ route('solicitudes.culminar', $s->id) }}"
                                        title="Culminar">
                                        ✅
                                    </a>
                                    @endif
                                    @endcan

                                    @can('solicitudes.eliminar')
                                    <form method="POST"
                                        action="{{ route('solicitudes.destroy', $s) }}"
                                        onsubmit="return confirm('¿Eliminar solicitud #{{ $s->id }}?')"
                                        class="or-inline-form">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                            class="or-icon-btn or-icon-btn-danger"
                                            title="Eliminar">
                                            🗑
                                        </button>
                                    </form>
                                    @endcan
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="11" class="or-muted" style="padding: 18px 10px; text-align:center;">
                                No hay solicitudes registradas con los filtros aplicados.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if(method_exists($solicitudes, 'links'))
            <div class="or-pagination-wrap">
                {{ $solicitudes->appends(request()->query())->links() }}
            </div>
            @endif
        </div>
    </div>
</div>

<script>
    setTimeout(function() {
        const hayFiltros = new URLSearchParams(window.location.search).toString().length > 0;

        if (!hayFiltros) {
            location.reload();
        }
    }, 10000);
</script>
@endsection