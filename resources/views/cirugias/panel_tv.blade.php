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

    #alertaCirugia {
        position: fixed;
        inset: 0;
        background: rgba(238, 244, 242, .94);
        z-index: 9999;
        display: flex;
        align-items: center;
        justify-content: center;
        backdrop-filter: blur(10px);
    }

    .alerta-box {
        text-align: center;
        padding: 42px;
        border-radius: 28px;
        background:
            radial-gradient(700px 360px at 18% 14%, rgba(214, 77, 77, .10), transparent 55%),
            linear-gradient(180deg, rgba(255, 255, 255, .96), rgba(255, 255, 255, .84));
        border: 1px solid rgba(214, 77, 77, .28);
        box-shadow: 0 24px 70px rgba(35, 64, 70, .18);
        max-width: 720px;
        color: var(--text);
    }

    .alerta-titulo {
        font-size: 34px;
        font-weight: 900;
        color: var(--danger);
        margin-bottom: 18px;
        letter-spacing: -.4px;
    }

    .alerta-hora {
        font-size: 58px;
        font-weight: 900;
        margin-bottom: 18px;
        color: #172f3a;
    }

    .alerta-info {
        font-size: 21px;
        line-height: 1.7;
        color: #40545c;
    }

    .tv-page {
        min-height: calc(100vh - 80px);
        padding: 26px 18px 34px;
        background:
            radial-gradient(900px 520px at 12% 12%, rgba(53, 200, 159, .18), transparent 58%),
            radial-gradient(900px 520px at 92% 18%, rgba(15, 143, 159, .12), transparent 55%),
            linear-gradient(135deg, var(--bg0) 0%, var(--bg1) 48%, #eaf2f0 100%);
        color: var(--text);
        position: relative;
        overflow: hidden;
    }

    .tv-page::before {
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

    .tv-wrap {
        width: min(1600px, 98vw);
        margin: 0 auto;
        position: relative;
        z-index: 1;
    }

    .tv-head {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        gap: 18px;
        margin-bottom: 20px;
    }

    .tv-title {
        margin: 0;
        font-size: 38px;
        font-weight: 900;
        letter-spacing: -.6px;
        color: #172f3a;
    }

    .tv-sub {
        margin: 8px 0 0;
        font-size: 17px;
        color: var(--muted);
        line-height: 1.5;
    }

    .tv-clock {
        text-align: right;
        min-width: 280px;
        padding: 14px 18px;
        border-radius: 20px;
        border: 1px solid rgba(25, 64, 72, .10);
        background: rgba(255, 255, 255, .78);
        box-shadow: var(--shadow2);
    }

    .tv-date {
        font-size: 17px;
        color: var(--muted);
        margin-bottom: 6px;
        font-weight: 700;
    }

    .tv-time {
        font-size: 44px;
        font-weight: 900;
        line-height: 1;
        color: #172f3a;
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
            radial-gradient(500px 260px at 16% 12%, rgba(53, 200, 159, .10), transparent 58%),
            linear-gradient(180deg, rgba(255, 255, 255, .94), rgba(255, 255, 255, .76));
        box-shadow: var(--shadow2);
        padding: 18px;
        position: relative;
        overflow: hidden;
    }

    .tv-card::after {
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

    .tv-card-label {
        color: var(--muted);
        font-size: 14px;
        font-weight: 900;
        text-transform: uppercase;
        letter-spacing: .5px;
        margin-bottom: 10px;
        position: relative;
        z-index: 1;
    }

    .tv-card-value {
        font-size: 42px;
        font-weight: 900;
        line-height: 1;
        color: #172f3a;
        position: relative;
        z-index: 1;
    }

    .tv-card-note {
        margin-top: 10px;
        color: var(--muted);
        font-size: 13px;
        font-weight: 700;
        position: relative;
        z-index: 1;
    }

    .tv-panel {
        border: 1px solid var(--line);
        border-radius: var(--radius);
        background:
            radial-gradient(500px 260px at 16% 12%, rgba(53, 200, 159, .08), transparent 58%),
            linear-gradient(180deg, rgba(255, 255, 255, .94), rgba(255, 255, 255, .76));
        box-shadow: var(--shadow);
        overflow: hidden;
        backdrop-filter: blur(14px);
    }

    .tv-panel-head {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 12px;
        padding: 16px 18px;
        border-bottom: 1px solid rgba(25, 64, 72, .10);
        background: rgba(255, 255, 255, .52);
    }

    .tv-panel-title {
        font-size: 20px;
        font-weight: 900;
        color: #17313b;
    }

    .tv-badge {
        color: #227e70;
        font-size: 13px;
        font-weight: 900;
        border: 1px solid rgba(53, 200, 159, .24);
        padding: 7px 12px;
        border-radius: 999px;
        background: rgba(53, 200, 159, .10);
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
        border-bottom: 1px solid rgba(25, 64, 72, .08);
        vertical-align: middle;
    }

    .tv-table th {
        font-size: 15px;
        font-weight: 900;
        color: #29414a;
        text-transform: uppercase;
        letter-spacing: .5px;
        background: rgba(255, 255, 255, .66);
    }

    .tv-table td {
        font-size: 20px;
        color: #40545c;
    }

    .tv-table tbody tr:hover td {
        background: rgba(53, 200, 159, .045);
    }

    .tv-time-cell {
        font-size: 26px !important;
        font-weight: 900;
        white-space: nowrap;
        color: #172f3a !important;
    }

    .tv-state {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 8px 14px;
        border-radius: 999px;
        font-size: 14px;
        font-weight: 900;
        border: 1px solid rgba(25, 64, 72, .10);
        white-space: nowrap;
    }

    .tv-state-p {
        background: rgba(53, 200, 159, .12);
        color: #1f8f77;
        border-color: rgba(53, 200, 159, .30);
    }

    .tv-state-e {
        background: rgba(124, 104, 201, .12);
        color: #6753b0;
        border-color: rgba(124, 104, 201, .24);
    }

    .tv-state-c {
        background: rgba(15, 143, 159, .12);
        color: #0b7f8e;
        border-color: rgba(15, 143, 159, .24);
    }

    .tv-state-s {
        background: rgba(200, 149, 45, .12);
        color: #9b6d13;
        border-color: rgba(200, 149, 45, .22);
    }

    .tv-type {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 7px 12px;
        border-radius: 999px;
        border: 1px solid rgba(25, 64, 72, .10);
        background: rgba(255, 255, 255, .72);
        color: #40545c;
        font-size: 14px;
        font-weight: 900;
        white-space: nowrap;
    }

    .tv-dot {
        width: 10px;
        height: 10px;
        border-radius: 999px;
        background: var(--primary);
        box-shadow: 0 0 0 4px rgba(53, 200, 159, .12);
    }

    .tv-dot.red {
        background: var(--danger);
        box-shadow: 0 0 0 4px rgba(214, 77, 77, .12);
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

        const mensaje = `Atención. Próxima cirugía en ${umbral} minutos. Hora programada ${horaTexto}. En ${cirugia.sala_operacion ?? 'sin sala asignada'}. Paciente ${cirugia.paciente ?? 'no especificado'}. Operación ${cirugia.operacion ?? 'no especificada'}. Cirujano principal ${cirugia.cirujano_principal ?? 'no especificado'}.`;

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
            <b>Operación:</b> ${c.operacion ?? '-'} <br>
            <b>Cirujano principal:</b> ${c.cirujano_principal ?? '-'}
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