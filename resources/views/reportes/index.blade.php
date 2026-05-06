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
        --danger: #ff6b6b;
        --warning: #ffd36b;
        --shadow: 0 18px 60px rgba(0, 0, 0, .45);
        --radius: 18px;
    }

    .rp-page {
        min-height: calc(100vh - 80px);
        padding: 24px 0 36px;
        background:
            radial-gradient(1100px 650px at 12% 10%, rgba(43, 212, 197, .10), transparent 60%),
            radial-gradient(900px 520px at 90% 15%, rgba(27, 179, 242, .10), transparent 55%),
            linear-gradient(180deg, var(--bg0), var(--bg1));
        color: var(--text);
    }

    .rp-container {
        width: min(1380px, 96vw);
        margin: 0 auto;
    }

    .rp-head {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        gap: 12px;
        flex-wrap: wrap;
        margin-bottom: 18px;
    }

    .rp-title {
        margin: 0;
        font-size: 30px;
        font-weight: 900;
    }

    .rp-sub {
        margin: 6px 0 0;
        color: var(--muted);
        font-size: 13px;
    }

    .rp-btn {
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

    .rp-btn:hover {
        border-color: rgba(27, 179, 242, .45);
        background: rgba(12, 40, 56, .55);
        color: var(--text);
        text-decoration: none;
    }

    .rp-btn-primary {
        background: linear-gradient(135deg, rgba(43, 212, 197, .20), rgba(27, 179, 242, .20));
        border-color: rgba(43, 212, 197, .28);
    }

    .rp-panel {
        border: 1px solid var(--line);
        border-radius: 18px;
        background:
            radial-gradient(900px 420px at 18% 20%, rgba(43, 212, 197, .10), transparent 55%),
            radial-gradient(700px 420px at 85% 30%, rgba(27, 179, 242, .08), transparent 55%),
            linear-gradient(180deg, rgba(12, 40, 56, .78), rgba(12, 40, 56, .40));
        box-shadow: var(--shadow);
        overflow: hidden;
        margin-bottom: 18px;
    }

    .rp-panel-head {
        padding: 14px 16px;
        border-bottom: 1px solid var(--line);
        font-weight: 900;
        font-size: 14px;
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
        font-weight: 800;
        margin-bottom: 6px;
        color: var(--muted);
    }

    .rp-input {
        width: 100%;
        height: 42px;
        border-radius: 12px;
        border: 1px solid rgba(255, 255, 255, .12);
        background: rgba(255, 255, 255, .04);
        color: var(--text);
        padding: 0 12px;
        outline: none;
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
        min-width: 1200px;
    }

    .rp-table th,
    .rp-table td {
        padding: 12px 10px;
        border-bottom: 1px solid rgba(255, 255, 255, .08);
        font-size: 12.5px;
        vertical-align: middle;
    }

    .rp-table th {
        color: rgba(234, 243, 248, .85);
        font-weight: 900;
        font-size: 12px;
        text-transform: uppercase;
        letter-spacing: .45px;
        background: rgba(12, 40, 56, .22);
    }

    .rp-empty {
        padding: 22px 12px;
        text-align: center;
        color: var(--muted);
        font-size: 13px;
    }

    .rp-pagination {
        padding: 16px;
        display: flex;
        justify-content: center;
    }
</style>

<div class="rp-page">
    <div class="rp-container">

        <div class="rp-head">
            <div>
                <h1 class="rp-title">Módulo de Reportes</h1>
                <p class="rp-sub">Consulta, filtra y exporta reportes de cirugías.</p>
            </div>

            <div>
                <a class="rp-btn" href="{{ url('/home') }}">Dashboard</a>
            </div>
        </div>

        <div class="rp-panel">
            <div class="rp-panel-head">Filtros de reporte</div>
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
                                    @php $sala='SALA ' . str_pad($i, 2, '0' , STR_PAD_LEFT); @endphp
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
            <div class="rp-panel-head">Resultados</div>

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
                            <td>{{ $r->tipo_solicitud }}</td>
                            <td>{{ $r->estado }}</td>
                            <td>{{ $r->para_el_dia }}</td>
                            <td>{{ $r->a_horas }}</td>
                            <td>{{ $r->fecha_programada }}</td>
                            <td>{{ $r->hora_programada }}</td>
                            <td>{{ $r->fecha_inicio }}</td>
                            <td>{{ $r->hora_inicio }}</td>
                            <td>{{ $r->fecha_culminacion }}</td>
                            <td>{{ $r->hora_culminacion }}</td>
                            <td>{{ $r->sala_operacion }}</td>
                            <td>{{ $r->paciente }}</td>
                            <td>{{ $r->operacion }}</td>
                            <td>{{ $r->servicio }}</td>
                            <td>{{ $r->cirujano_principal }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="16" class="rp-empty">No hay resultados para los filtros seleccionados.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if(method_exists($reportes, 'links'))
            <div class="rp-pagination">
                {{ $reportes->links() }}
            </div>
            @endif
        </div>
    </div>
</div>
@endsection