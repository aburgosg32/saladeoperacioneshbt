@extends('layouts.app')

@section('content')
<style>
    #alertaCirugia {
        position: fixed;
        inset: 0;
        background: rgba(3, 16, 24, 0.95);
        z-index: 9999;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .alerta-box {
        text-align: center;
        padding: 40px;
        border-radius: 24px;
        background: linear-gradient(135deg, #0a1d28, #0f2f3f);
        border: 2px solid rgba(43, 212, 197, .5);
        box-shadow: 0 0 40px rgba(43, 212, 197, .3);
        max-width: 600px;
    }

    .alerta-titulo {
        font-size: 32px;
        font-weight: 900;
        color: #ff6b6b;
        margin-bottom: 20px;
    }

    .alerta-hora {
        font-size: 48px;
        font-weight: 900;
        margin-bottom: 20px;
    }

    .alerta-info {
        font-size: 20px;
        line-height: 1.6;
        color: #eaf3f8;
    }

    :root {
        --bg0: #031018;
        --bg1: #08202b;
        --line: rgba(255, 255, 255, .12);
        --text: #eef8fc;
        --muted: rgba(238, 248, 252, .72);
        --primary: #2bd4c5;
        --primary2: #1bb3f2;
        --danger: #ff6b6b;
        --warning: #ffd36b;
        --success: #2bd4c5;
        --shadow: 0 18px 60px rgba(0, 0, 0, .40);
        --radius: 22px;
    }

    .tv-page {
        min-height: calc(100vh - 80px);
        padding: 20px 18px 28px;
        background:
            radial-gradient(1400px 800px at 10% 12%, rgba(43, 212, 197, .12), transparent 60%),
            radial-gradient(1200px 700px at 90% 15%, rgba(27, 179, 242, .10), transparent 58%),
            linear-gradient(180deg, var(--bg0), var(--bg1));
        color: var(--text);
    }

    .tv-wrap {
        width: min(1600px, 98vw);
        margin: 0 auto;
    }

    .tv-head {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        gap: 18px;
        margin-bottom: 18px;
    }

    .tv-title {
        margin: 0;
        font-size: 38px;
        font-weight: 900;
        letter-spacing: -.4px;
    }

    .tv-sub {
        margin: 8px 0 0;
        font-size: 17px;
        color: var(--muted);
    }

    .tv-clock {
        text-align: right;
        min-width: 280px;
    }

    .tv-date {
        font-size: 18px;
        color: var(--muted);
        margin-bottom: 6px;
    }

    .tv-time {
        font-size: 44px;
        font-weight: 900;
        line-height: 1;
    }

    .tv-grid {
        display: grid;
        grid-template-columns: repeat(6, 1fr);
        gap: 16px;
        margin-bottom: 20px;
    }

    .tv-card {
        border: 1px solid var(--line);
        border-radius: var(--radius);
        background:
            radial-gradient(700px 220px at 18% 20%, rgba(43, 212, 197, .12), transparent 55%),
            linear-gradient(180deg, rgba(12, 40, 56, .78), rgba(12, 40, 56, .42));
        box-shadow: var(--shadow);
        padding: 18px;
    }

    .tv-card-label {
        color: var(--muted);
        font-size: 14px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: .5px;
        margin-bottom: 10px;
    }

    .tv-card-value {
        font-size: 42px;
        font-weight: 900;
        line-height: 1;
    }

    .tv-card-note {
        margin-top: 10px;
        color: var(--muted);
        font-size: 13px;
    }

    .tv-panel {
        border: 1px solid var(--line);
        border-radius: var(--radius);
        background:
            radial-gradient(1000px 420px at 18% 20%, rgba(43, 212, 197, .10), transparent 55%),
            radial-gradient(800px 420px at 85% 30%, rgba(27, 179, 242, .08), transparent 55%),
            linear-gradient(180deg, rgba(12, 40, 56, .78), rgba(12, 40, 56, .42));
        box-shadow: var(--shadow);
        overflow: hidden;
    }

    .tv-panel-head {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 12px;
        padding: 16px 18px;
        border-bottom: 1px solid var(--line);
    }

    .tv-panel-title {
        font-size: 20px;
        font-weight: 900;
    }

    .tv-badge {
        color: var(--muted);
        font-size: 13px;
        border: 1px solid var(--line);
        padding: 7px 12px;
        border-radius: 999px;
        background: rgba(12, 40, 56, .30);
    }

    .tv-table-wrap {
        padding: 0 10px 10px;
        overflow: hidden;
    }

    .tv-table {
        width: 100%;
        border-collapse: collapse;
    }

    .tv-table th,
    .tv-table td {
        padding: 16px 12px;
        border-bottom: 1px solid rgba(255, 255, 255, .08);
        vertical-align: middle;
    }

    .tv-table th {
        font-size: 15px;
        font-weight: 900;
        color: rgba(238, 248, 252, .88);
        text-transform: uppercase;
        letter-spacing: .5px;
        background: rgba(12, 40, 56, .22);
    }

    .tv-table td {
        font-size: 20px;
        color: var(--text);
    }

    .tv-time-cell {
        font-size: 26px;
        font-weight: 900;
        white-space: nowrap;
    }

    .tv-state {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 8px 14px;
        border-radius: 999px;
        font-size: 14px;
        font-weight: 900;
        border: 1px solid rgba(255, 255, 255, .12);
        white-space: nowrap;
    }

    .tv-state-p {
        background: rgba(43, 212, 197, .12);
        color: #2bd4c5;
        border-color: rgba(43, 212, 197, .28);
    }

    .tv-state-e {
        background: rgba(155, 123, 255, .12);
        color: #c7b5ff;
        border-color: rgba(155, 123, 255, .30);
    }

    .tv-state-c {
        background: rgba(27, 179, 242, .12);
        color: #7fd8ff;
        border-color: rgba(27, 179, 242, .28);
    }

    .tv-state-s {
        background: rgba(255, 193, 7, .12);
        color: #ffd36b;
        border-color: rgba(255, 193, 7, .28);
    }

    .tv-type {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 7px 12px;
        border-radius: 999px;
        border: 1px solid var(--line);
        background: rgba(12, 40, 56, .25);
        font-size: 14px;
        font-weight: 900;
        white-space: nowrap;
    }

    .tv-dot {
        width: 10px;
        height: 10px;
        border-radius: 999px;
        background: var(--primary);
    }

    .tv-dot.red {
        background: var(--danger);
    }

    .tv-empty {
        padding: 28px 14px;
        text-align: center;
        font-size: 18px;
        color: var(--muted);
    }

    @media (max-width: 1400px) {
        .tv-grid {
            grid-template-columns: repeat(3, 1fr);
        }
    }

    @media (max-width: 900px) {
        .tv-head {
            flex-direction: column;
            align-items: flex-start;
        }

        .tv-clock {
            text-align: left;
        }

        .tv-grid {
            grid-template-columns: 1fr;
        }

        .tv-table-wrap {
            overflow-x: auto;
        }

        .tv-table {
            min-width: 1100px;
        }
    }
</style>

<div class="tv-page">
    <div id="alertaCirugia" style="display:none;">
        <div class="alerta-box">
            <div class="alerta-titulo">🚨 PRÓXIMA CIRUGÍA</div>
            <div class="alerta-hora" id="alertaHora"></div>
            <div class="alerta-info" id="alertaInfo"></div>
        </div>
    </div>

    <div class="tv-wrap">

        <div class="tv-head">
            <div>
                <h1 class="tv-title">Panel de Cirugías • Sala de Operaciones</h1>
                <p class="tv-sub">Monitoreo diario de cirugías programadas, en curso y culminadas.</p>
            </div>

            <div class="tv-clock">
                <div class="tv-date" id="tvDate"></div>
                <div class="tv-time" id="tvTime"></div>
            </div>
        </div>

        <div class="tv-grid">
            <div class="tv-card">
                <div class="tv-card-label">Total hoy</div>
                <div class="tv-card-value">{{ $totalHoy }}</div>
                <div class="tv-card-note">Cirugías programadas para hoy</div>
            </div>

            <div class="tv-card">
                <div class="tv-card-label">Programadas</div>
                <div class="tv-card-value">{{ $programadas }}</div>
                <div class="tv-card-note">Pendientes de ejecución</div>
            </div>

            <div class="tv-card">
                <div class="tv-card-label">Culminadas</div>
                <div class="tv-card-value">{{ $culminadas }}</div>
                <div class="tv-card-note">Finalizadas hoy</div>
            </div>

            <div class="tv-card">
                <div class="tv-card-label">Emergencias</div>
                <div class="tv-card-value">{{ $emergencias }}</div>
                <div class="tv-card-note">Cirugías de emergencia</div>
            </div>

            <div class="tv-card">
                <div class="tv-card-label">Salas ocupadas</div>
                <div class="tv-card-value">{{ $salasOcupadas }}</div>
                <div class="tv-card-note">Salas activas registradas</div>
            </div>

            <div class="tv-card">
                <div class="tv-card-label">Próxima cirugía</div>
                <div class="tv-card-value" style="font-size:34px;">
                    {{ $proximaCirugia && $proximaCirugia->hora_programada ? \Carbon\Carbon::parse($proximaCirugia->hora_programada)->format('H:i') : '-' }}
                </div>
                <div class="tv-card-note">
                    {{ $proximaCirugia->sala_operacion ?? 'Sin sala asignada' }}
                </div>
            </div>
        </div>

        <div class="tv-panel">
            <div class="tv-panel-head">
                <div class="tv-panel-title">Operaciones del día</div>
                <div class="tv-badge">Actualización automática</div>
            </div>

            <div class="tv-table-wrap">
                <table class="tv-table">
                    <thead>
                        <tr>
                            <th>Hora</th>
                            <th>Sala</th>
                            <th>Tipo</th>
                            <th>Paciente</th>
                            <th>Operación</th>
                            <th>Cirujano</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($cirugiasHoy as $c)
                        <tr>
                            <td class="tv-time-cell">
                                {{ $c->hora_programada ? \Carbon\Carbon::parse($c->hora_programada)->format('H:i') : '-' }}
                            </td>

                            <td>{{ $c->sala_operacion ?? '-' }}</td>

                            <td>
                                @if($c->tipo_solicitud === 'EMERGENCIA')
                                <span class="tv-type">
                                    <span class="tv-dot red"></span> EMERG.
                                </span>
                                @else
                                <span class="tv-type">
                                    <span class="tv-dot"></span> PROG.
                                </span>
                                @endif
                            </td>

                            <td>{{ $c->paciente ?? '-' }}</td>
                            <td>{{ $c->operacion ?? '-' }}</td>
                            <td>{{ $c->cirujano_principal ?? '-' }}</td>

                            <td>
                                @if($c->estado === 'P')
                                <span class="tv-state tv-state-p">Programado</span>
                                @elseif($c->estado === 'E')
                                <span class="tv-state tv-state-e">En curso</span>
                                @elseif($c->estado === 'C')
                                <span class="tv-state tv-state-c">Culminado</span>
                                @else
                                <span class="tv-state tv-state-s">Solicitado</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="tv-empty">
                                No hay cirugías programadas para hoy.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>

<script>
    const cirugiasHoy = @json($cirugiasHoy);
</script>

<script>
    let alertaActiva = false;

    function obtenerClaveAlerta(cirugia, umbral) {
        return `alerta_cirugia_${cirugia.id}_${cirugia.hora_programada}_${umbral}`;
    }

    function alertaYaMostrada(cirugia, umbral) {
        const clave = obtenerClaveAlerta(cirugia, umbral);
        return localStorage.getItem(clave) === '1';
    }

    function marcarAlertaMostrada(cirugia, umbral) {
        const clave = obtenerClaveAlerta(cirugia, umbral);
        localStorage.setItem(clave, '1');
    }

    function hablarAlerta(cirugia, umbral) {
        if (!('speechSynthesis' in window)) return;

        const horaTexto = new Date('1970-01-01T' + cirugia.hora_programada).toLocaleTimeString('es-PE', {
            hour: '2-digit',
            minute: '2-digit'
        });

        const mensaje = `Atención. Próxima cirugía en ${umbral} minutos. Hora programada ${horaTexto}. Sala ${cirugia.sala_operacion ?? 'sin sala asignada'}. Paciente ${cirugia.paciente ?? 'no especificado'}. Operación ${cirugia.operacion ?? 'no especificada'}.`;

        const utterance = new SpeechSynthesisUtterance(mensaje);
        utterance.lang = 'es-PE';
        utterance.rate = 0.95;
        utterance.pitch = 1;
        utterance.volume = 1;

        window.speechSynthesis.cancel();
        window.speechSynthesis.speak(utterance);
    }

    function mostrarAlerta(c, umbral) {
        if (alertaActiva) return;

        alertaActiva = true;

        document.getElementById('alertaHora').innerText =
            new Date('1970-01-01T' + c.hora_programada).toLocaleTimeString('es-PE', {
                hour: '2-digit',
                minute: '2-digit'
            });

        document.getElementById('alertaInfo').innerHTML = `
            <div style="margin-bottom:10px;"><b>Inicia en ${umbral} minutos</b></div>
            <b>Sala:</b> ${c.sala_operacion ?? '-'} <br>
            <b>Paciente:</b> ${c.paciente ?? '-'} <br>
            <b>Operación:</b> ${c.operacion ?? '-'}
        `;

        const alerta = document.getElementById('alertaCirugia');
        alerta.style.display = 'flex';

        hablarAlerta(c, umbral);

        setTimeout(() => {
            alerta.style.display = 'none';
            alertaActiva = false;
        }, 30000);
    }

    function verificarAlertas() {
        const ahora = new Date();

        cirugiasHoy.forEach(c => {
            if (!c.hora_programada || c.estado !== 'P') return;

            const hoyLocal = ahora.getFullYear() + '-' +
                String(ahora.getMonth() + 1).padStart(2, '0') + '-' +
                String(ahora.getDate()).padStart(2, '0');

            const fechaHora = new Date(`${hoyLocal}T${c.hora_programada}`);
            const diffMin = (fechaHora - ahora) / 1000 / 60;

            if (diffMin > 29 && diffMin <= 30) {
                if (!alertaYaMostrada(c, 30) && !alertaActiva) {
                    marcarAlertaMostrada(c, 30);
                    mostrarAlerta(c, 30);
                }
            }

            if (diffMin > 14 && diffMin <= 15) {
                if (!alertaYaMostrada(c, 15) && !alertaActiva) {
                    marcarAlertaMostrada(c, 15);
                    mostrarAlerta(c, 15);
                }
            }
        });
    }

    function actualizarRelojTV() {
        const ahora = new Date();

        const fecha = ahora.toLocaleDateString('es-PE', {
            weekday: 'long',
            year: 'numeric',
            month: 'long',
            day: 'numeric'
        });

        const hora = ahora.toLocaleTimeString('es-PE', {
            hour: '2-digit',
            minute: '2-digit',
            second: '2-digit'
        });

        document.getElementById('tvDate').textContent = fecha;
        document.getElementById('tvTime').textContent = hora;
    }

    actualizarRelojTV();
    setInterval(actualizarRelojTV, 1000);

    verificarAlertas();
    setInterval(verificarAlertas, 10000);

    setTimeout(function() {
        location.reload();
    }, 60000);
</script>
@endsection