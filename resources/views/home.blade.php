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

        --shadow: 0 22px 60px rgba(35, 64, 70, .14);
        --shadow2: 0 10px 30px rgba(35, 64, 70, .10);
        --radius: 22px;
    }

    .or-dash-wrap {
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

    .or-dash-wrap::before {
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

    .or-dash-container {
        width: min(1120px, 92vw);
        margin: 0 auto;
        position: relative;
        z-index: 1;
    }

    .or-head {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        gap: 18px;
        flex-wrap: wrap;
        margin-bottom: 22px;
    }

    .or-title {
        font-size: 28px;
        font-weight: 900;
        margin: 0 0 8px;
        color: #172f3a;
        letter-spacing: -.4px;
    }

    .or-sub {
        margin: 0;
        color: var(--muted);
        font-size: 14px;
        line-height: 1.7;
    }

    .or-user-pill {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        padding: 10px 14px;
        border-radius: 999px;
        border: 1px solid rgba(53, 200, 159, .24);
        background: rgba(53, 200, 159, .10);
        color: #227e70;
        font-size: 13px;
        font-weight: 800;
        white-space: nowrap;
    }

    .or-user-dot {
        width: 10px;
        height: 10px;
        border-radius: 999px;
        background: var(--ok);
        box-shadow: 0 0 0 6px rgba(47, 190, 143, .15);
    }

    .or-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 16px;
    }

    @media (max-width: 980px) {
        .or-grid {
            grid-template-columns: 1fr;
        }
    }

    .or-card {
        border: 1px solid var(--line);
        border-radius: var(--radius);
        background:
            radial-gradient(500px 260px at 16% 12%, rgba(53, 200, 159, .10), transparent 58%),
            linear-gradient(180deg, rgba(255, 255, 255, .94), rgba(255, 255, 255, .76));
        padding: 18px;
        box-shadow: var(--shadow2);
        display: flex;
        flex-direction: column;
        gap: 12px;
        min-height: 168px;
        position: relative;
        overflow: hidden;
        transition: transform .16s ease, box-shadow .16s ease, border-color .16s ease;
    }

    .or-card:hover {
        transform: translateY(-2px);
        border-color: rgba(53, 200, 159, .28);
        box-shadow: 0 18px 36px rgba(35, 64, 70, .14);
    }

    .or-card::after {
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

    .or-card h4 {
        margin: 0;
        font-size: 15px;
        font-weight: 900;
        color: #17313b;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 10px;
        position: relative;
        z-index: 1;
    }

    .or-badge {
        font-size: 11px;
        padding: 5px 10px;
        border-radius: 999px;
        border: 1px solid rgba(25, 64, 72, .10);
        color: #6f7f86;
        background: rgba(255, 255, 255, .72);
        white-space: nowrap;
    }

    .or-badge.ok {
        border-color: rgba(53, 200, 159, .30);
        color: #1f8f77;
        background: rgba(53, 200, 159, .10);
        font-weight: 900;
    }

    .or-card p {
        margin: 0;
        color: var(--muted);
        font-size: 13px;
        line-height: 1.7;
        position: relative;
        z-index: 1;
    }

    .or-actions {
        margin-top: auto;
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
        position: relative;
        z-index: 1;
    }

    .or-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        padding: 10px 13px;
        border-radius: 15px;
        border: 1px solid rgba(25, 64, 72, .10);
        background: rgba(255, 255, 255, .78);
        color: #253c45;
        text-decoration: none;
        font-size: 12.5px;
        font-weight: 900;
        transition: transform .15s ease, border-color .15s ease, background .15s ease, box-shadow .15s ease;
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
</style>

<div class="or-dash-wrap">
    <div class="or-dash-container">

        <div class="or-head">
            <div>
                <h1 class="or-title">Dashboard • Sala de Operaciones</h1>
                <p class="or-sub">
                    Bienvenido, <strong>{{ Auth::user()->name }}</strong>. Selecciona un módulo para comenzar.
                </p>
            </div>

            <div class="or-user-pill">
                <span class="or-user-dot"></span>
                Sistema operativo
            </div>
        </div>

        <div class="or-grid">

            @can('solicitudes.ver')
            <div class="or-card">
                <h4>
                    Solicitudes y Programación
                    <span class="or-badge ok">Activo</span>
                </h4>

                <p>
                    Registro y control de solicitudes de Sala de Operaciones.
                    Incluye listado, creación, edición, detalle y eliminación.
                    Además permite programar las operaciones.
                </p>

                <div class="or-actions">
                    <a class="or-btn or-btn-primary" href="{{ route('solicitudes.index') }}">
                        Abrir módulo
                    </a>

                    @can('solicitudes.crear')
                    <a class="or-btn" href="{{ route('solicitudes.create') }}">
                        Nueva solicitud
                    </a>
                    @endcan
                </div>
            </div>
            @endcan

            @can('paneltv.ver')
            <div class="or-card">
                <h4>
                    PanelTV
                    <span class="or-badge ok">Activo</span>
                </h4>

                <p>
                    Visualización de programación médica desde una pantalla,
                    con audio, alertas y notificaciones previas a la cirugía.
                </p>

                <div class="or-actions">
                    <a class="or-btn or-btn-primary" href="{{ route('cirugias.panel_tv') }}">
                        Abrir módulo
                    </a>
                </div>
            </div>
            @endcan

            @can('paneltv.ver')
            <div class="or-card">
                <h4>
                    Monitor de Salas
                    <span class="or-badge ok">Activo</span>
                </h4>

                <p>
                    Visualización de las 6 salas de operaciones en pantalla completa.
                    Muestra paciente, operación, médico y hora de inicio por cada sala.
                </p>

                <div class="or-actions">
                    <a class="or-btn or-btn-primary" href="{{ route('cirugias.salas') }}">
                        Abrir módulo
                    </a>
                </div>
            </div>
            @endcan

            @can('panel.ver')
            <div class="or-card">
                <h4>
                    Panel de Control
                    <span class="or-badge ok">Activo</span>
                </h4>

                <p>
                    Dashboard con estadísticas de cirugías, próximas intervenciones,
                    indicadores, gráficos y resumen operativo general.
                </p>

                <div class="or-actions">
                    <a href="{{ route('cirugias.index') }}" class="or-btn or-btn-primary">
                        Abrir módulo
                    </a>
                </div>
            </div>
            @endcan

            @can('ejecucion.ver')
            <div class="or-card">
                <h4>
                    Ejecución y Culminación
                    <span class="or-badge ok">Activo</span>
                </h4>

                <p>
                    Permite iniciar una operación, cambiar estado a en curso
                    y culminar el procedimiento registrando información final.
                </p>

                <div class="or-actions">
                    <a class="or-btn or-btn-primary" href="{{ route('ejecucion-cirugias.index') }}">
                        Abrir módulo
                    </a>
                </div>
            </div>
            @endcan

            @can('reportes.ver')
            <div class="or-card">
                <h4>
                    Reportes
                    <span class="or-badge ok">Activo</span>
                </h4>

                <p>
                    Consulta y exportación de reportes de cirugías por fecha,
                    sala, estado, tipo de solicitud y otros criterios.
                </p>

                <div class="or-actions">
                    <a class="or-btn or-btn-primary" href="{{ route('reportes.index') }}">
                        Abrir módulo
                    </a>
                </div>
            </div>
            @endcan

        </div>
    </div>
</div>
@endsection