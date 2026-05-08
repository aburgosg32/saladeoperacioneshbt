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
        --shadow: 0 22px 60px rgba(35, 64, 70, .14);
        --shadow2: 0 10px 30px rgba(35, 64, 70, .10);
        --radius: 22px;
    }

    .rp-page {
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

    .rp-page::before {
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

    .rp-container {
        width: min(1380px, 96vw);
        margin: 0 auto;
        position: relative;
        z-index: 1;
    }

    .rp-head {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        gap: 16px;
        flex-wrap: wrap;
        margin-bottom: 18px;
    }

    .rp-title {
        margin: 0;
        font-size: 30px;
        font-weight: 900;
        letter-spacing: -.4px;
        color: #172f3a;
    }

    .rp-sub {
        margin: 6px 0 0;
        color: var(--muted);
        font-size: 13.5px;
        line-height: 1.7;
    }

    .rp-actions-top {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
    }

    .rp-btn {
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

    .rp-btn:hover {
        transform: translateY(-1px);
        background: #ffffff;
        border-color: rgba(53, 200, 159, .30);
        box-shadow: 0 10px 26px rgba(35, 64, 70, .10);
        color: #253c45;
        text-decoration: none;
    }

    .rp-btn-primary {
        border-color: rgba(53, 200, 159, .44);
        background: linear-gradient(135deg, #35c89f, #13a889);
        color: #ffffff;
        box-shadow: 0 12px 26px rgba(53, 200, 159, .20);
    }

    .rp-btn-primary:hover {
        background: linear-gradient(135deg, #39d6aa, #0f9f83);
        color: #ffffff;
    }

    .rp-panel {
        border: 1px solid var(--line);
        border-radius: var(--radius);
        background:
            radial-gradient(500px 260px at 16% 12%, rgba(53, 200, 159, .08), transparent 58%),
            linear-gradient(180deg, rgba(255, 255, 255, .94), rgba(255, 255, 255, .76));
        box-shadow: var(--shadow);
        overflow: hidden;
        margin-bottom: 18px;
        backdrop-filter: blur(14px);
    }

    .rp-panel-head {
        padding: 14px 16px;
        border-bottom: 1px solid rgba(25, 64, 72, .10);
        font-weight: 900;
        font-size: 14px;
        color: #17313b;
        background: rgba(255, 255, 255, .52);
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        flex-wrap: wrap;
    }

    .rp-count {
        color: #227e70;
        font-size: 12px;
        font-weight: 900;
        border: 1px solid rgba(53, 200, 159, .24);
        padding: 6px 10px;
        border-radius: 999px;
        background: rgba(53, 200, 159, .10);
    }

    .rp-panel-body {
        padding: 16px;
    }

    .rp-form-grid {
        display: grid;
        grid-template-columns: repeat(5, 1fr);
        gap: 14px;
    }

    @media (max-width: 1100px) {
        .rp-form-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 700px) {
        .rp-form-grid {
            grid-template-columns: 1fr;
        }
    }

    .rp-field label {
        display: block;
        font-size: 12px;
        font-weight: 900;
        margin-bottom: 6px;
        color: #29414a;
        letter-spacing: .3px;
        text-transform: uppercase;
    }

    .rp-input {
        width: 100%;
        height: 42px;
        border-radius: 15px;
        border: 1px solid rgba(25, 64, 72, .10);
        background: rgba(255, 255, 255, .88);
        color: #20313a;
        padding: 0 12px;
        outline: none;
        font-size: 13px;
        font-weight: 700;
        transition: .15s ease;
    }

    .rp-input:focus {
        border-color: rgba(53, 200, 159, .55);
        background: #ffffff;
        box-shadow: 0 0 0 4px rgba(53, 200, 159, .10);
    }

    .rp-input option {
        background: #ffffff;
        color: #20313a;
    }

    .rp-actions {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
        margin-top: 16px;
    }

    .rp-table-wrap {
        overflow-x: auto;
        padding: 0 8px 12px;
    }

    .rp-table {
        width: 100%;
        border-collapse: collapse;
        min-width: 1050px;
    }

    .rp-table th,
    .rp-table td {
        padding: 9px 7px;
        border-bottom: 1px solid rgba(25, 64, 72, .08);
        font-size: 10.8px;
        vertical-align: middle;
    }

    .rp-table th {
        color: #29414a;
        font-weight: 900;
        font-size: 10.5px;
        text-transform: uppercase;
        letter-spacing: .45px;
        background: rgba(255, 255, 255, .66);
    }

    .rp-table td {
        color: #40545c;
        font-weight: 700;
    }

    .rp-table tbody tr:hover td {
        background: rgba(53, 200, 159, .045);
    }

    .rp-state {
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

    .rp-state-s {
        background: rgba(200, 149, 45, .12);
        color: #9b6d13;
        border-color: rgba(200, 149, 45, .22);
    }

    .rp-state-p {
        background: rgba(53, 200, 159, .12);
        color: #1f8f77;
        border-color: rgba(53, 200, 159, .30);
    }

    .rp-state-e {
        background: rgba(124, 104, 201, .12);
        color: #6753b0;
        border-color: rgba(124, 104, 201, .24);
    }

    .rp-state-c {
        background: rgba(15, 143, 159, .12);
        color: #0b7f8e;
        border-color: rgba(15, 143, 159, .24);
    }

    .rp-type {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 5px 9px;
        border-radius: 999px;
        font-size: 11px;
        font-weight: 900;
        border: 1px solid rgba(25, 64, 72, .10);
        white-space: nowrap;
        background: rgba(255, 255, 255, .72);
        color: #40545c;
    }

    .rp-type-emergencia {
        background: rgba(214, 77, 77, .10);
        color: #b43d3d;
        border-color: rgba(214, 77, 77, .25);
    }

    .rp-type-programada {
        background: rgba(53, 200, 159, .12);
        color: #1f8f77;
        border-color: rgba(53, 200, 159, .30);
    }

    .rp-empty {
        padding: 22px 12px;
        text-align: center;
        color: var(--muted);
        font-size: 13px;
        font-weight: 700;
    }

    .rp-pagination {
        padding: 16px;
        display: flex;
        justify-content: center;
        overflow-x: auto;
    }

    .rp-pagination nav {
        width: auto;
    }

    .rp-pagination svg {
        width: 16px !important;
        height: 16px !important;
        max-width: 16px !important;
        max-height: 16px !important;
        vertical-align: middle;
    }

    .rp-pagination .hidden.sm\:flex-1,
    .rp-pagination .sm\:hidden {
        display: none !important;
    }

    .rp-pagination .sm\:flex {
        display: flex !important;
        align-items: center;
        justify-content: center;
        gap: 8px;
        flex-wrap: wrap;
    }

    .rp-pagination [aria-label="Pagination Navigation"]>div:first-child {
        display: none !important;
    }

    .rp-pagination [aria-label="Pagination Navigation"]>div:last-child {
        display: flex !important;
        justify-content: center;
        align-items: center;
        gap: 8px;
        flex-wrap: wrap;
    }

    .rp-pagination a,
    .rp-pagination span[aria-current="page"] span,
    .rp-pagination span[aria-disabled="true"] span {
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

    .rp-pagination a:hover {
        border-color: rgba(53, 200, 159, .30);
        background: #ffffff;
        color: #253c45 !important;
    }

    .rp-pagination span[aria-current="page"] span {
        background: linear-gradient(135deg, #35c89f, #13a889);
        border-color: rgba(53, 200, 159, .44);
        color: #ffffff !important;
    }

    .rp-pagination span[aria-disabled="true"] span {
        opacity: .45;
        cursor: not-allowed;
    }
</style>

<div class="rp-page">
    <div class="rp-container">

        <div class="rp-head">
            <div>
                <h1 class="rp-title">Módulo de Reportes</h1>
                <p class="rp-sub">Consulta, filtra y exporta reportes de cirugías.</p>
            </div>

            <div class="rp-actions-top">
                <a class="rp-btn" href="{{ route('home') }}">Menu Principal</a>
            </div>
        </div>

        <div class="rp-panel">
            <div class="rp-panel-head">
                <span>Filtros de reporte</span>
                <span class="rp-count">
                    Total: {{ method_exists($reportes, 'total') ? $reportes->total() : count($reportes) }}
                </span>
            </div>

            <div class="rp-panel-body">
                <form method="GET" action="{{ route('reportes.index') }}">
                    <div class="rp-form-grid">
                        <div class="rp-field">
                            <label>Fecha inicio</label>
                            <input type="date" name="fecha_inicio" class="rp-input" value="{{ request('fecha_inicio') }}">
                        </div>

                        <div class="rp-field">
                            <label>Fecha fin</label>
                            <input type="date" name="fecha_fin" class="rp-input" value="{{ request('fecha_fin') }}">
                        </div>

                        <div class="rp-field">
                            <label>Sala</label>
                            <select name="sala_operacion" class="rp-input">
                                <option value="">Todas</option>
                                @for($i = 1; $i <= 6; $i++)
                                    @php
                                    $sala='SALA ' . str_pad($i, 2, '0' , STR_PAD_LEFT);
                                    @endphp
                                    <option value="{{ $sala }}" {{ request('sala_operacion') == $sala ? 'selected' : '' }}>
                                    {{ $sala }}
                                    </option>
                                    @endfor
                            </select>
                        </div>

                        <div class="rp-field">
                            <label>Estado</label>
                            <select name="estado" class="rp-input">
                                <option value="">Todos</option>
                                <option value="S" {{ request('estado') == 'S' ? 'selected' : '' }}>Solicitado</option>
                                <option value="P" {{ request('estado') == 'P' ? 'selected' : '' }}>Programado</option>
                                <option value="E" {{ request('estado') == 'E' ? 'selected' : '' }}>En curso</option>
                                <option value="C" {{ request('estado') == 'C' ? 'selected' : '' }}>Culminado</option>
                            </select>
                        </div>

                        <div class="rp-field">
                            <label>Tipo</label>
                            <select name="tipo_solicitud" class="rp-input">
                                <option value="">Todos</option>
                                <option value="PROGRAMADA" {{ request('tipo_solicitud') == 'PROGRAMADA' ? 'selected' : '' }}>PROGRAMADA</option>
                                <option value="EMERGENCIA" {{ request('tipo_solicitud') == 'EMERGENCIA' ? 'selected' : '' }}>EMERGENCIA</option>
                            </select>
                        </div>
                    </div>

                    <div class="rp-actions">
                        <button type="submit" class="rp-btn rp-btn-primary">Filtrar</button>

                        <a href="{{ route('reportes.index') }}" class="rp-btn">Limpiar</a>

                        @can('reportes.exportar')
                        <a href="{{ route('reportes.exportar.excel', request()->query()) }}" class="rp-btn rp-btn-primary">
                            Exportar Excel
                        </a>
                        @endcan

                        @can('reportes.exportar')
                        <a href="{{ route('reportes.exportar.pdf', request()->query()) }}" class="rp-btn">
                            Exportar PDF
                        </a>
                        @endcan
                    </div>
                </form>
            </div>
        </div>

        <div class="rp-panel">
            <div class="rp-panel-head">
                <span>Resultados</span>
                <span class="rp-count">Listado quirúrgico</span>
            </div>

            <div class="rp-table-wrap">
                <table class="rp-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tipo</th>
                            <th>Estado</th>
                            <th>Fecha Solicitud</th>
                            <th>Hora Solicitud</th>
                            <th>Fecha Programada</th>
                            <th>Hora Programada</th>
                            <th>Fecha Inicio</th>
                            <th>Hora Inicio</th>
                            <th>Fecha Culminación</th>
                            <th>Hora Culminación</th>
                            <th>Sala</th>
                            <th>Paciente</th>
                            <th>Operación</th>
                            <th>Servicio</th>
                            <th>Cirujano</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($reportes as $r)
                        <tr>
                            <td>{{ $r->id }}</td>

                            <td>
                                @if($r->tipo_solicitud === 'EMERGENCIA')
                                <span class="rp-type rp-type-emergencia">EMERG.</span>
                                @else
                                <span class="rp-type rp-type-programada">PROG.</span>
                                @endif
                            </td>

                            <td>
                                @if($r->estado === 'P')
                                <span class="rp-state rp-state-p">Programado</span>
                                @elseif($r->estado === 'E')
                                <span class="rp-state rp-state-e">En curso</span>
                                @elseif($r->estado === 'C')
                                <span class="rp-state rp-state-c">Culminado</span>
                                @else
                                <span class="rp-state rp-state-s">Solicitado</span>
                                @endif
                            </td>

                            <td>{{ $r->para_el_dia ? \Carbon\Carbon::parse($r->para_el_dia)->format('d/m/Y') : '-' }}</td>
                            <td>{{ $r->a_horas ? \Carbon\Carbon::parse($r->a_horas)->format('H:i') : '-' }}</td>
                            <td>{{ $r->fecha_programada ? \Carbon\Carbon::parse($r->fecha_programada)->format('d/m/Y') : '-' }}</td>
                            <td>{{ $r->hora_programada ? \Carbon\Carbon::parse($r->hora_programada)->format('H:i') : '-' }}</td>
                            <td>{{ $r->fecha_inicio ? \Carbon\Carbon::parse($r->fecha_inicio)->format('d/m/Y') : '-' }}</td>
                            <td>{{ $r->hora_inicio ? \Carbon\Carbon::parse($r->hora_inicio)->format('H:i') : '-' }}</td>
                            <td>{{ $r->fecha_culminacion ? \Carbon\Carbon::parse($r->fecha_culminacion)->format('d/m/Y') : '-' }}</td>
                            <td>{{ $r->hora_culminacion ? \Carbon\Carbon::parse($r->hora_culminacion)->format('H:i') : '-' }}</td>
                            <td>{{ $r->sala_operacion ?? '-' }}</td>
                            <td>{{ $r->paciente ?? '-' }}</td>
                            <td>{{ $r->operacion ?? '-' }}</td>
                            <td>{{ $r->servicio ?? '-' }}</td>
                            <td>{{ $r->cirujano_principal ?? '-' }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="16" class="rp-empty">
                                No hay resultados para los filtros seleccionados.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if(method_exists($reportes, 'links'))
            <div class="rp-pagination">
                {{ $reportes->appends(request()->query())->links() }}
            </div>
            @endif
        </div>
    </div>
</div>
@endsection