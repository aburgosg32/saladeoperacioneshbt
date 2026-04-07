@extends('layouts.app')

@section('content')
<style>
    .or-dash-wrap {
        min-height: calc(100vh - 80px);
        padding: 28px 0;
        background:
            radial-gradient(1100px 650px at 12% 10%, rgba(43, 212, 197, .10), transparent 60%),
            radial-gradient(900px 520px at 90% 15%, rgba(27, 179, 242, .10), transparent 55%),
            linear-gradient(180deg, #061218, #0a1d28);
        color: #eaf3f8;
    }

    .or-dash-container {
        width: min(1100px, 92vw);
        margin: 0 auto;
    }

    .or-title {
        font-size: 24px;
        font-weight: 800;
        margin: 0 0 6px;
    }

    .or-sub {
        margin: 0 0 18px;
        color: rgba(234, 243, 248, .72);
        font-size: 13px;
    }

    .or-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 14px;
    }

    @media (max-width: 900px) {
        .or-grid {
            grid-template-columns: 1fr;
        }
    }

    .or-card {
        border: 1px solid rgba(255, 255, 255, .12);
        border-radius: 18px;
        background: rgba(12, 40, 56, .55);
        padding: 16px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, .25);
        display: flex;
        flex-direction: column;
        gap: 10px;
        min-height: 150px;
    }

    .or-card h4 {
        margin: 0;
        font-size: 14px;
        font-weight: 800;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 10px;
    }

    .or-badge {
        font-size: 11px;
        padding: 4px 10px;
        border-radius: 999px;
        border: 1px solid rgba(255, 255, 255, .12);
        color: rgba(234, 243, 248, .75);
        background: rgba(12, 40, 56, .40);
        white-space: nowrap;
    }

    .or-badge.ok {
        border-color: rgba(43, 212, 197, .35);
        color: rgba(43, 212, 197, .95);
        background: rgba(43, 212, 197, .08);
    }

    .or-card p {
        margin: 0;
        color: rgba(234, 243, 248, .72);
        font-size: 12.5px;
        line-height: 1.6;
    }

    .or-actions {
        margin-top: auto;
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
    }

    .or-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        padding: 9px 12px;
        border-radius: 14px;
        border: 1px solid rgba(255, 255, 255, .12);
        background: rgba(12, 40, 56, .35);
        color: #eaf3f8;
        text-decoration: none;
        font-size: 12.5px;
        font-weight: 700;
        transition: transform .15s ease, border-color .15s ease, background .15s ease;
    }

    .or-btn:hover {
        transform: translateY(-1px);
        border-color: rgba(27, 179, 242, .45);
        background: rgba(12, 40, 56, .55);
        color: #eaf3f8;
    }

    .or-btn-primary {
        border-color: rgba(43, 212, 197, .60);
        background: linear-gradient(135deg, rgba(43, 212, 197, .18), rgba(27, 179, 242, .14));
    }

    .or-btn-primary:hover {
        border-color: rgba(43, 212, 197, .90);
    }
</style>

<div class="or-dash-wrap">
    <div class="or-dash-container">
        <h1 class="or-title">Dashboard • Sala de Operaciones</h1>
        <p class="or-sub">
            Bienvenido, <strong>{{ Auth::user()->name }}</strong>. Selecciona un módulo para comenzar.
        </p>

        <div class="or-grid">

            {{-- ✅ MODULO PRINCIPAL: SOLICITUDES --}}
            <div class="or-card">
                <h4>
                    Solicitudes y Programación
                    <span class="or-badge ok">Activo</span>
                </h4>
                <p>
                    Registro y control de Solicitudes de Sala de Operaciones.
                    Incluye listado, creación, edición, detalle y eliminación.
                    Además se programará todas las operaciones.
                </p>

                <div class="or-actions">
                    <a class="or-btn or-btn-primary" href="{{ route('solicitudes.index') }}">
                        Abrir módulo
                    </a>
                    <a class="or-btn" href="{{ route('solicitudes.create') }}">
                        Nueva solicitud
                    </a>
                </div>
            </div>

            {{-- MODULOS FUTUROS --}}
            <div class="or-card">
                <h4>
                    PanelTV
                    <span class="or-badge ok">Activo</span>
                </h4>
                <p>Visualización de programación médica desde una pantalla, con audio y notificaciones.</p>
                <div class="or-actions">
                    <a class="or-btn or-btn-primary" href="{{ route('cirugias.panel_tv') }}">Abrir módulo</a>
                </div>
            </div>

            <div class="or-card">
                <h4>
                    Panel Control
                    <span class="or-badge ok">Activo</span>
                </h4>
                <p>Dashboard con las estadisticas de cirugias, proximas cirugias, gráficos.</p>
                <div class="or-actions">
                    <a href="{{ route('cirugias.index') }}" class="or-btn or-btn-primary">Abrir módulo</a>
                </div>
            </div>

            <div class="or-card">
                <h4>
                   Ejecución y Culminación
                    <span class="or-badge ok">Activo</span>
                </h4>
                <p>Dar inicio a una operación registrando información. Dar fin a la operación registrando información.
                    Considera validación de operaciones.
                </p>
                <div class="or-actions">
                    <a class="or-btn or-btn-primary" href="{{ route('ejecucion-cirugias.index') }}" >Abrir módulo</a>
                </div>
            </div>
            <div class="or-card">
                <h4>
                   Reportes
                    <span class="or-badge ok">Activo</span>
                </h4>
                <p>Generar reportes para informacion estadistica. Exportación de registros a Excel para impresión.
                </p>
                <div class="or-actions">
                    <a class="or-btn or-btn-primary" href="{{ route('ejecucion-cirugias.index') }}" >Abrir módulo</a>
                </div>
            </div>


        </div>
    </div>
</div>
@endsection