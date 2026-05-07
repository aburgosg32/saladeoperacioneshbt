@extends('layouts.app')

@section('content')
<style>
    .or-state-badge {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 5px 10px;
        border-radius: 999px;
        font-size: 11px;
        font-weight: 800;
        letter-spacing: .2px;
        border: 1px solid rgba(255, 255, 255, .12);
        white-space: nowrap;
    }

    .or-state-s {
        background: rgba(255, 193, 7, .12);
        color: #ffd36b;
        border-color: rgba(255, 193, 7, .28);
    }

    .or-state-a {
        background: rgba(43, 212, 197, .12);
        color: #2bd4c5;
        border-color: rgba(43, 212, 197, .28);
    }

    .or-state-c {
        background: rgba(27, 179, 242, .12);
        color: #7fd8ff;
        border-color: rgba(27, 179, 242, .28);
    }

    .or-state-e {
        background: rgba(155, 123, 255, .12);
        color: #c7b5ff;
        border-color: rgba(155, 123, 255, .30);
    }

    :root {
        --bg0: #061218;
        --bg1: #0a1d28;
        --panel: rgba(12, 40, 56, .62);
        --panel2: rgba(12, 40, 56, .35);
        --line: rgba(255, 255, 255, .12);
        --text: #eaf3f8;
        --muted: rgba(234, 243, 248, .72);
        --primary: #2bd4c5;
        --primary2: #1bb3f2;
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
        width: min(1280px, 96vw);
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
        max-width: 78ch;
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
        gap: 10px;
        padding: 10px 14px;
        border-radius: 14px;
        border: 1px solid var(--line);
        background: rgba(12, 40, 56, .35);
        color: var(--text);
        text-decoration: none;
        font-size: 12.5px;
        font-weight: 800;
        transition: transform .15s ease, border-color .15s ease, background .15s ease;
        white-space: nowrap;
        cursor: pointer;
    }

    .or-btn:hover {
        transform: translateY(-1px);
        border-color: rgba(27, 179, 242, .45);
        background: rgba(12, 40, 56, .55);
        color: var(--text);
    }

    .or-btn-primary {
        border-color: rgba(43, 212, 197, .60);
        background: linear-gradient(135deg, rgba(43, 212, 197, .18), rgba(27, 179, 242, .14));
    }

    .or-btn-primary:hover {
        border-color: rgba(43, 212, 197, .90);
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
        backdrop-filter: blur(10px);
    }

    .or-panel-head {
        padding: 14px 16px;
        border-bottom: 1px solid var(--line);
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        flex-wrap: wrap;
    }

    .or-panel-head .label {
        font-weight: 900;
        font-size: 13px;
        letter-spacing: .2px;
    }

    .or-count {
        color: var(--muted);
        font-size: 12px;
        border: 1px solid var(--line);
        padding: 6px 10px;
        border-radius: 999px;
        background: rgba(12, 40, 56, .30);
    }

    .or-alert {
        margin-bottom: 12px;
        border: 1px solid rgba(43, 212, 197, .35);
        background: rgba(43, 212, 197, .08);
        color: rgba(234, 243, 248, .9);
        padding: 12px 14px;
        border-radius: 16px;
        font-size: 12.5px;
        font-weight: 700;
    }

    .or-filter-panel {
        border: 1px solid var(--line);
        border-radius: var(--radius);
        background:
            radial-gradient(700px 260px at 10% 10%, rgba(43, 212, 197, .08), transparent 55%),
            linear-gradient(180deg, rgba(12, 40, 56, .72), rgba(12, 40, 56, .38));
        box-shadow: var(--shadow);
        padding: 14px 16px;
        margin-bottom: 14px;
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
        color: rgba(234, 243, 248, .80);
        font-size: 11px;
        font-weight: 900;
        text-transform: uppercase;
        letter-spacing: .4px;
    }

    .or-filter-input,
    .or-filter-select {
        width: 100%;
        border-radius: 14px;
        border: 1px solid rgba(255, 255, 255, .10);
        background: rgba(6, 18, 24, .35);
        color: var(--text);
        padding: 10px 10px;
        outline: none;
        font-size: 13px;
    }

    .or-filter-input:focus,
    .or-filter-select:focus {
        border-color: rgba(43, 212, 197, .75);
        background: rgba(6, 18, 24, .55);
    }

    .or-filter-select option {
        background: #0a1d28;
        color: #eaf3f8;
    }

    .or-filter-c2 {
        grid-column: span 2;
    }

    .or-filter-c3 {
        grid-column: span 3;
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
        .or-filter-c3,
        .or-filter-c4,
        .or-filter-actions {
            grid-column: span 12;
        }
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
        border-bottom: 1px solid rgba(255, 255, 255, .08);
        font-size: 12.5px;
        vertical-align: middle;
    }

    .or-table th {
        color: rgba(234, 243, 248, .85);
        font-weight: 900;
        font-size: 12px;
        text-transform: uppercase;
        letter-spacing: .5px;
        background: rgba(12, 40, 56, .22);
    }

    .or-table td {
        color: rgba(234, 243, 248, .85);
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
        border: 1px solid var(--line);
        background: rgba(12, 40, 56, .25);
        font-size: 11px;
        font-weight: 800;
        letter-spacing: .2px;
        white-space: nowrap;
    }

    .or-dot {
        width: 8px;
        height: 8px;
        border-radius: 999px;
        background: var(--primary);
        box-shadow: 0 0 0 4px rgba(43, 212, 197, .10);
    }

    .or-dot.red {
        background: rgba(255, 107, 107, .95);
        box-shadow: 0 0 0 4px rgba(255, 107, 107, .10);
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
        border-radius: 12px;
        border: 1px solid rgba(255, 255, 255, .12);
        background: rgba(12, 40, 56, .35);
        color: var(--text);
        text-decoration: none;
        font-size: 15px;
        transition: transform .15s ease, border-color .15s ease, background .15s ease;
    }

    .or-icon-btn:hover {
        transform: translateY(-1px);
        border-color: rgba(27, 179, 242, .45);
        background: rgba(12, 40, 56, .55);
        color: var(--text);
    }

    .or-icon-btn-danger {
        cursor: pointer;
    }

    .or-icon-btn-danger:hover {
        border-color: rgba(255, 107, 107, .70);
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
        font-weight: 700;
        line-height: 1.3;
    }

    .or-hora {
        font-size: 11px;
        color: var(--muted);
        line-height: 1.3;
        margin-top: 2px;
    }

    .or-sala {
        white-space: nowrap;
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
        border-radius: 12px;
        border: 1px solid rgba(255, 255, 255, .12);
        background: rgba(12, 40, 56, .35);
        color: var(--text) !important;
        text-decoration: none !important;
        font-size: 12.5px;
        font-weight: 800;
        line-height: 1;
        box-shadow: none !important;
    }

    .or-pagination-wrap a:hover {
        border-color: rgba(27, 179, 242, .45);
        background: rgba(12, 40, 56, .55);
        color: var(--text) !important;
    }

    .or-pagination-wrap span[aria-current="page"] span {
        background: linear-gradient(135deg, rgba(43, 212, 197, .18), rgba(27, 179, 242, .14));
        border-color: rgba(43, 212, 197, .60);
        color: #fff !important;
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
                <a class="or-btn" href="{{ route('home') }}">Dashboard</a>

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
    }, 5000);
</script>
@endsection